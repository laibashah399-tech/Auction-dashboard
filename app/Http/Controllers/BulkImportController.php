<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\BulkImport;
use App\Models\Lot;
use App\Models\LotImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;


class BulkImportController extends Controller
{
    /**
     * Display bulk imports.
     */
    public function index()
    {
        $imports = BulkImport::with('auction')
            ->latest()
            ->paginate(10);

        $totalImports = BulkImport::count();

        $successfulImports = BulkImport::where(
            'status',
            'completed'
        )->count();

        $partialImports = BulkImport::where(
            'status',
            'partial'
        )->count();

        $failedImports = BulkImport::where(
            'status',
            'failed'
        )->count();

        return view('imports.index', compact(
            'imports',
            'totalImports',
            'successfulImports',
            'partialImports',
            'failedImports'
        ));
    }

    /**
     * Show import form.
     */
    public function create()
    {
        $auctions = Auction::latest()->get();

        return view('imports.create', compact('auctions'));
    }

    /**
     * Import lots from CSV.
     *
     * Supported image values:
     *
     * 1. Windows local path
     *    C:\images\image1.jpg
     *
     * 2. Multiple Windows paths
     *    C:\images\image1.jpg|C:\images\image2.jpg
     *
     * 3. Laravel public storage path
     *    lots/watch.jpg
     *
     * 4. storage/ path
     *    storage/lots/watch.jpg
     *
     * 5. Public URL
     *    https://example.com/watch.jpg
     *
     * 6. Base64
     *    data:image/png;base64,...
     *
     * Images are copied to:
     * storage/app/public/lots/
     */
    public function store(Request $request)
    {
        $request->validate([
            'auction_id' => [
                'required',
                'exists:auctions,id',
            ],

            'csv_file' => [
                'required',
                'file',
                'mimes:csv,txt',
                'max:512000',
            ],
        ]);

        $file = $request->file('csv_file');

        $originalFileName = $file->getClientOriginalName();

        $csvPath = $file->getRealPath();

        if (!$csvPath || !file_exists($csvPath)) {
            return back()
                ->withErrors([
                    'csv_file' => 'Unable to read uploaded CSV file.',
                ])
                ->withInput();
        }

        $handle = fopen($csvPath, 'r');

        if (!$handle) {
            return back()
                ->withErrors([
                    'csv_file' => 'Unable to open CSV file.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Read CSV header
        |--------------------------------------------------------------------------
        */

        $header = fgetcsv($handle);

        if (!$header) {
            fclose($handle);

            return back()
                ->withErrors([
                    'csv_file' => 'CSV file is empty.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Remove BOM
        |--------------------------------------------------------------------------
        */

        if (isset($header[0])) {
            $header[0] = preg_replace(
                '/^\xEF\xBB\xBF/',
                '',
                $header[0]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Clean headers
        |--------------------------------------------------------------------------
        */

        $header = array_map(function ($value) {
            $value = preg_replace(
                '/^\xEF\xBB\xBF/',
                '',
                (string) $value
            );

            return strtolower(trim($value));
        }, $header);

        /*
        |--------------------------------------------------------------------------
        | Accept both "image" and "images"
        |--------------------------------------------------------------------------
        */

        if (
            in_array('image', $header, true) &&
            !in_array('images', $header, true)
        ) {
            $imageIndex = array_search(
                'image',
                $header,
                true
            );

            if ($imageIndex !== false) {
                $header[$imageIndex] = 'images';
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Required columns
        |--------------------------------------------------------------------------
        |
        | Image is intentionally NOT required.
        |
        */

        $requiredColumns = [
            'lot_number',
            'title',
            'description',
            'starting_price',
            'current_bid',
            'status',
        ];

        foreach ($requiredColumns as $column) {
            if (!in_array($column, $header, true)) {
                fclose($handle);

                return back()
                    ->withErrors([
                        'csv_file' =>
                            "Missing required column: {$column}",
                    ])
                    ->withInput();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Add images column if CSV doesn't have it
        |--------------------------------------------------------------------------
        */

        if (!in_array('images', $header, true)) {
            $header[] = 'images';
        }

        $imagesIndex = array_search(
            'images',
            $header,
            true
        );

        /*
        |--------------------------------------------------------------------------
        | Counters
        |--------------------------------------------------------------------------
        */

        $totalRows = 0;
        $successfulRows = 0;
        $failedRows = 0;

        DB::beginTransaction();

        try {
            /*
            |--------------------------------------------------------------------------
            | Create import history
            |--------------------------------------------------------------------------
            */

            $import = BulkImport::create([
                'auction_id' => $request->auction_id,
                'file_name' => $originalFileName,
                'total_rows' => 0,
                'successful_rows' => 0,
                'failed_rows' => 0,
                'status' => 'completed',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Read rows
            |--------------------------------------------------------------------------
            */

            while (($row = fgetcsv($handle)) !== false) {

                /*
                |--------------------------------------------------------------------------
                | Ignore completely empty rows
                |--------------------------------------------------------------------------
                */

                if (
                    count($row) === 1 &&
                    trim((string) $row[0]) === ''
                ) {
                    continue;
                }

                $totalRows++;

                /*
                |--------------------------------------------------------------------------
                | IMPORTANT:
                |--------------------------------------------------------------------------
                |
                | The images column is the LAST column.
                |
                | If an image value contains commas, such as Base64,
                | combine everything from imagesIndex onward.
                |
                */

                $expectedColumns = count($header);

                if (count($row) > $expectedColumns) {

                    $firstPart = array_slice(
                        $row,
                        0,
                        $imagesIndex
                    );

                    $imageParts = array_slice(
                        $row,
                        $imagesIndex
                    );

                    $row = array_merge(
                        $firstPart,
                        [
                            implode(',', $imageParts)
                        ]
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | If row has fewer columns, fill missing values
                |--------------------------------------------------------------------------
                */

                if (count($row) < $expectedColumns) {
                    $row = array_pad(
                        $row,
                        $expectedColumns,
                        ''
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Validate column count
                |--------------------------------------------------------------------------
                */

                if (count($row) !== $expectedColumns) {
                    $failedRows++;
                    continue;
                }

                $data = array_combine(
                    $header,
                    $row
                );

                if ($data === false) {
                    $failedRows++;
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Required fields
                |--------------------------------------------------------------------------
                */

                $lotNumber = trim(
                    (string) ($data['lot_number'] ?? '')
                );

                $title = trim(
                    (string) ($data['title'] ?? '')
                );

                if (
                    $lotNumber === '' ||
                    $title === ''
                ) {
                    $failedRows++;
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Duplicate lot number
                |--------------------------------------------------------------------------
                */

                $lotExists = Lot::where(
                    'lot_number',
                    $lotNumber
                )->exists();

                if ($lotExists) {
                    $failedRows++;
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | PROCESS MULTIPLE IMAGES
                |--------------------------------------------------------------------------
                |
                | CSV example:
                |
                | C:\images\image1.jpg|C:\images\image2.jpg
                |
                | First image becomes the main thumbnail.
                | All images are stored in lot_images.
                |
                */

                $imagePaths = [];

                $imageValue = trim(
                    (string) ($data['images'] ?? '')
                );

                if ($imageValue !== '') {

                    /*
                    |--------------------------------------------------------------------------
                    | Split multiple images using |
                    |--------------------------------------------------------------------------
                    */

                    $imageValues = array_filter(
                        array_map(
                            'trim',
                            explode('|', $imageValue)
                        )
                    );

                    foreach ($imageValues as $singleImage) {

                        $processedImage = $this->processImage(
                            $singleImage,
                            $csvPath
                        );

                        if ($processedImage) {
                            $imagePaths[] = $processedImage;
                        }
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | First image = main thumbnail
                |--------------------------------------------------------------------------
                */

                $imagePath = $imagePaths[0] ?? null;

                /*
                |--------------------------------------------------------------------------
                | Create lot
                |--------------------------------------------------------------------------
                */

                $lot = Lot::create([
                    'auction_id' => $request->auction_id,

                    'import_id' => $import->id,

                    'lot_number' => $lotNumber,

                    'title' => $title,

                    'description' =>
                        trim(
                            (string) ($data['description'] ?? '')
                        ) !== ''
                            ? trim(
                                (string) $data['description']
                            )
                            : null,

                    'starting_price' =>
                        is_numeric(
                            $data['starting_price'] ?? null
                        )
                            ? $data['starting_price']
                            : 0,

                    'current_bid' =>
                        is_numeric(
                            $data['current_bid'] ?? null
                        )
                            ? $data['current_bid']
                            : 0,

                    'status' =>
                        $this->normalizeStatus(
                            $data['status'] ?? ''
                        ),

                    /*
                    |--------------------------------------------------------------------------
                    | First image is main image
                    |--------------------------------------------------------------------------
                    */

                    'image' => $imagePath,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Save ALL images in lot_images
                |--------------------------------------------------------------------------
                */

                foreach ($imagePaths as $path) {

                    LotImage::create([
                        'lot_id' => $lot->id,
                        'image' => $path,
                    ]);
                }

                $successfulRows++;
            }

            /*
            |--------------------------------------------------------------------------
            | Determine import status
            |--------------------------------------------------------------------------
            */

            if (
                $successfulRows > 0 &&
                $failedRows === 0
            ) {
                $status = 'completed';

            } elseif ($successfulRows > 0) {
                $status = 'partial';

            } else {
                $status = 'failed';
            }

            /*
            |--------------------------------------------------------------------------
            | Update import history
            |--------------------------------------------------------------------------
            */

            $import->update([
                'total_rows' => $totalRows,
                'successful_rows' => $successfulRows,
                'failed_rows' => $failedRows,
                'status' => $status,
            ]);

            DB::commit();

            if (is_resource($handle)) {
                fclose($handle);
            }

            return redirect()
                ->route('bulk-imports.index')
                ->with(
                    'success',
                    "{$successfulRows} lots imported successfully. {$failedRows} rows failed."
                );

        } catch (Throwable $e) {

            DB::rollBack();

            if (is_resource($handle)) {
                fclose($handle);
            }

            return back()
                ->withErrors([
                    'csv_file' =>
                        'Import failed: ' . $e->getMessage(),
                ])
                ->withInput();
        }
    }

    /**
     * Process any supported image reference.
     *
     * Supported:
     *
     * C:\images\image1.jpg
     * C:\images\image1.jpg|C:\images\image2.jpg
     * https://example.com/image.jpg
     * lots/image.jpg
     * storage/lots/image.jpg
     * Base64 image
     * public/image.jpg
     * Relative image path
     */
    private function processImage(
        string $imageValue,
        string $csvPath
    ): ?string {

        $imageValue = trim($imageValue);

        if ($imageValue === '') {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Remove surrounding quotes
        |--------------------------------------------------------------------------
        */

        $imageValue = trim(
            $imageValue,
            "\"'"
        );

        /*
        |--------------------------------------------------------------------------
        | 1. BASE64 IMAGE
        |--------------------------------------------------------------------------
        */

        if (
            preg_match(
                '/^data:image\/([a-zA-Z0-9.+-]+);base64,(.*)$/is',
                $imageValue,
                $matches
            )
        ) {
            return $this->saveBase64Image(
                $matches[1],
                $matches[2]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 2. HTTP / HTTPS URL
        |--------------------------------------------------------------------------
        */

        if (
            filter_var(
                $imageValue,
                FILTER_VALIDATE_URL
            )
        ) {
            return $this->downloadRemoteImage(
                $imageValue
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 3. WINDOWS LOCAL PATH
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | C:\images\image1.jpg
        |
        | C:\images\image1.jpg|C:\images\image2.jpg
        |
        | At this point processImage() receives ONE path,
        | because store() already splits images using "|".
        |
        */

        $windowsPath = trim($imageValue);

        /*
        | Convert forward slashes to Windows slashes.
        */

        $windowsPath = str_replace(
            '/',
            '\\',
            $windowsPath
        );

        /*
        | Remove accidental surrounding quotes again.
        */

        $windowsPath = trim(
            $windowsPath,
            "\"'"
        );

        /*
        |--------------------------------------------------------------------------
        | Check absolute Windows path
        |--------------------------------------------------------------------------
        */

        if (
            preg_match(
                '/^[A-Za-z]:[\\\\\/]/',
                $windowsPath
            ) &&
            file_exists($windowsPath) &&
            is_file($windowsPath)
        ) {
            return $this->copyLocalImage(
                $windowsPath
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Laravel storage path
        |--------------------------------------------------------------------------
        |
        | Examples:
        |
        | lots/watch.jpg
        | storage/lots/watch.jpg
        |
        */

        $storagePath = str_replace(
            '\\',
            '/',
            $imageValue
        );

        $storagePath = ltrim(
            $storagePath,
            '/'
        );

        /*
        | Remove "storage/" prefix.
        */

        if (
            str_starts_with(
                strtolower($storagePath),
                'storage/'
            )
        ) {
            $storagePath = substr(
                $storagePath,
                strlen('storage/')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Check public disk
        |--------------------------------------------------------------------------
        */

        if (
            Storage::disk('public')->exists(
                $storagePath
            )
        ) {
            return $this->copyStorageImage(
                $storagePath
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 5. public/ path
        |--------------------------------------------------------------------------
        */

        $publicRelativePath = str_replace(
            ['/', '\\'],
            DIRECTORY_SEPARATOR,
            $storagePath
        );

        $publicPath = public_path(
            ltrim(
                $publicRelativePath,
                DIRECTORY_SEPARATOR
            )
        );

        if (
            file_exists($publicPath) &&
            is_file($publicPath)
        ) {
            return $this->copyLocalImage(
                $publicPath
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Laravel project path
        |--------------------------------------------------------------------------
        */

        $projectPath = base_path(
            ltrim(
                $publicRelativePath,
                DIRECTORY_SEPARATOR
            )
        );

        if (
            file_exists($projectPath) &&
            is_file($projectPath)
        ) {
            return $this->copyLocalImage(
                $projectPath
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 7. Relative path beside CSV
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | CSV:
        | C:\imports\lots.csv
        |
        | Image:
        | images\watch.jpg
        |
        */

        $csvDirectory = dirname($csvPath);

        $relativeImagePath = str_replace(
            ['/', '\\'],
            DIRECTORY_SEPARATOR,
            $imageValue
        );

        $relativePath = $csvDirectory .
            DIRECTORY_SEPARATOR .
            ltrim(
                $relativeImagePath,
                DIRECTORY_SEPARATOR
            );

        if (
            file_exists($relativePath) &&
            is_file($relativePath)
        ) {
            return $this->copyLocalImage(
                $relativePath
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Image not found
        |--------------------------------------------------------------------------
        |
        | Image failure does NOT fail the lot.
        |
        */

        return null;
    }

    /**
     * Download image from URL.
     */
    private function downloadRemoteImage(
        string $url
    ): ?string {

        try {

            $response = Http::timeout(30)
                ->withoutRedirecting()
                ->get($url);

            if (!$response->successful()) {
                return null;
            }

            $contents = $response->body();

            if ($contents === '') {
                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Determine MIME
            |--------------------------------------------------------------------------
            */

            $mime = $response->header(
                'Content-Type'
            );

            $mime = strtolower(
                trim(
                    explode(';', (string) $mime)[0]
                )
            );

            /*
            |--------------------------------------------------------------------------
            | Determine extension
            |--------------------------------------------------------------------------
            */

            $extension =
                $this->extensionFromMime($mime);

            if ($extension === null) {
                $extension =
                    $this->extensionFromPath($url);
            }

            if ($extension === null) {
                $extension = 'img';
            }

            return $this->saveImageContents(
                $contents,
                $extension
            );

        } catch (Throwable $e) {

            return null;
        }
    }

    /**
     * Copy local image.
     */
    private function copyLocalImage(
        string $filePath
    ): ?string {

        if (!file_exists($filePath)) {
            return null;
        }

        if (!is_file($filePath)) {
            return null;
        }

        $contents = file_get_contents(
            $filePath
        );

        if ($contents === false) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Get extension from path
        |--------------------------------------------------------------------------
        */

        $extension =
            $this->extensionFromPath(
                $filePath
            );

        /*
        |--------------------------------------------------------------------------
        | Try MIME if extension isn't available
        |--------------------------------------------------------------------------
        */

        if ($extension === null) {

            $mime = @mime_content_type(
                $filePath
            );

            $extension =
                $this->extensionFromMime(
                    $mime
                );
        }

        if ($extension === null) {
            $extension = 'img';
        }

        return $this->saveImageContents(
            $contents,
            $extension,
            basename($filePath)
        );
    }

    /**
     * Copy an existing Laravel storage image.
     */
    private function copyStorageImage(
        string $storagePath
    ): ?string {

        try {

            $contents = Storage::disk('public')
                ->get($storagePath);

            $extension =
                $this->extensionFromPath(
                    $storagePath
                );

            if ($extension === null) {
                $extension = 'img';
            }

            return $this->saveImageContents(
                $contents,
                $extension,
                basename($storagePath)
            );

        } catch (Throwable $e) {

            return null;
        }
    }

    /**
     * Save Base64 image.
     */
    private function saveBase64Image(
        string $extension,
        string $encoded
    ): ?string {

        /*
        |--------------------------------------------------------------------------
        | Remove whitespace from Base64
        |--------------------------------------------------------------------------
        */

        $encoded = preg_replace(
            '/\s+/',
            '',
            $encoded
        );

        $contents = base64_decode(
            $encoded,
            true
        );

        if ($contents === false) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Normalize extension
        |--------------------------------------------------------------------------
        */

        $extension = strtolower(
            trim($extension)
        );

        $extension = match ($extension) {

            'jpeg' => 'jpg',

            'svg+xml' => 'svg',

            'x-icon' => 'ico',

            default => $extension,
        };

        if ($extension === '') {
            $extension = 'img';
        }

        return $this->saveImageContents(
            $contents,
            $extension
        );
    }

    /**
     * Save image bytes to public storage.
     */
    private function saveImageContents(
        string $contents,
        string $extension,
        ?string $originalName = null
    ): ?string {

        if ($contents === '') {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Clean extension
        |--------------------------------------------------------------------------
        */

        $extension = strtolower(
            preg_replace(
                '/[^a-zA-Z0-9]/',
                '',
                $extension
            )
        );

        if ($extension === '') {
            $extension = 'img';
        }

        /*
        |--------------------------------------------------------------------------
        | Create readable unique filename
        |--------------------------------------------------------------------------
        */

        if ($originalName) {

            $baseName = pathinfo(
                $originalName,
                PATHINFO_FILENAME
            );

            $baseName = preg_replace(
                '/[^A-Za-z0-9_-]/',
                '_',
                $baseName
            );

            if ($baseName === '') {
                $baseName = 'lot_image';
            }

        } else {

            $baseName = 'lot_image';
        }

        $fileName =
            $baseName .
            '_' .
            uniqid() .
            '.' .
            $extension;

        $path = 'lots/' . $fileName;

        /*
        |--------------------------------------------------------------------------
        | Save to storage/app/public/lots/
        |--------------------------------------------------------------------------
        */

        $saved = Storage::disk('public')->put(
            $path,
            $contents
        );

        if (!$saved) {
            return null;
        }

        return $path;
    }

    /**
     * Get extension from MIME.
     */
    private function extensionFromMime(
        ?string $mime
    ): ?string {

        if (!$mime) {
            return null;
        }

        $mime = strtolower(
            trim(
                explode(';', $mime)[0]
            )
        );

        return match ($mime) {

            'image/jpeg',
            'image/jpg' => 'jpg',

            'image/png' => 'png',

            'image/gif' => 'gif',

            'image/webp' => 'webp',

            'image/svg+xml' => 'svg',

            'image/bmp',
            'image/x-ms-bmp' => 'bmp',

            'image/tiff' => 'tiff',

            'image/avif' => 'avif',

            'image/x-icon',
            'image/vnd.microsoft.icon' => 'ico',

            'image/heic' => 'heic',

            'image/heif' => 'heif',

            default => null,
        };
    }

    /**
     * Get extension from file/path/URL.
     */
    private function extensionFromPath(
        string $path
    ): ?string {

        $parsedPath = parse_url(
            $path,
            PHP_URL_PATH
        );

        $extension = strtolower(
            pathinfo(
                $parsedPath ?: $path,
                PATHINFO_EXTENSION
            )
        );

        if ($extension === '') {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Supported common image formats
        |--------------------------------------------------------------------------
        */

        $allowed = [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp',
            'svg',
            'bmp',
            'tif',
            'tiff',
            'avif',
            'ico',
            'heic',
            'heif',
        ];

        if (in_array($extension, $allowed, true)) {
            return $extension === 'jpeg'
                ? 'jpg'
                : $extension;
        }

        /*
        |--------------------------------------------------------------------------
        | Don't reject unknown extension
        |--------------------------------------------------------------------------
        */

        return preg_match(
            '/^[a-z0-9]{1,10}$/',
            $extension
        )
            ? $extension
            : null;
    }

    /**
     * Normalize lot status.
     */
    private function normalizeStatus(
        $status
    ): string {

        $status = strtolower(
            trim((string) $status)
        );

        return in_array(
            $status,
            [
                'available',
                'sold',
                'unsold',
            ],
            true
        )
            ? $status
            : 'available';
    }

    /**
     * Delete one bulk import and ONLY its lots/images.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $import = BulkImport::find($id);

            if (!$import) {

                DB::rollBack();

                return redirect()
                    ->route('bulk-imports.index')
                    ->withErrors([
                        'delete' =>
                            "Bulk import #{$id} was not found."
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Get only lots belonging to this import
            |--------------------------------------------------------------------------
            */

            $lots = Lot::where(
                'import_id',
                $import->id
            )
                ->with('images')
                ->get();

            foreach ($lots as $lot) {

                /*
                |--------------------------------------------------------------------------
                | Delete main lot image
                |--------------------------------------------------------------------------
                */

                if (
                    !empty($lot->image) &&
                    Storage::disk('public')->exists(
                        $lot->image
                    )
                ) {
                    Storage::disk('public')->delete(
                        $lot->image
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Delete all multiple images
                |--------------------------------------------------------------------------
                */

                foreach ($lot->images as $lotImage) {

                    if (
                        !empty($lotImage->image) &&
                        Storage::disk('public')->exists(
                            $lotImage->image
                        )
                    ) {
                        Storage::disk('public')->delete(
                            $lotImage->image
                        );
                    }

                    $lotImage->delete();
                }

                /*
                |--------------------------------------------------------------------------
                | Delete lot
                |--------------------------------------------------------------------------
                */

                $lot->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Delete import record
            |--------------------------------------------------------------------------
            */

            $import->delete();

            DB::commit();

            return redirect()
                ->route('bulk-imports.index')
                ->with(
                    'success',
                    'Import, its lots and all their images were deleted successfully.'
                );

        } catch (Throwable $e) {

            DB::rollBack();

            return redirect()
                ->route('bulk-imports.index')
                ->withErrors([
                    'delete' =>
                        'Unable to delete import: ' .
                        $e->getMessage(),
                ]);
        }
    }
}

