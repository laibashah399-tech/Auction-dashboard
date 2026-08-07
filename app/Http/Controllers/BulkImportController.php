<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\BulkImport;
use App\Models\Lot;
use App\Models\LotImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class BulkImportController extends Controller
{
    /**
     * Show all bulk imports.
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
     * Import CSV file.
     *
     * Multiple images are supported.
     *
     * CSV example:
     *
     * lot_number,title,description,starting_price,current_bid,status,images
     *
     * LOT-001,Antique Chair,Beautiful chair,500,500,available,chair1.jpg|chair2.jpg|chair3.jpg
     */
    public function store(Request $request)
    {
        $request->validate([
            'auction_id' => 'required|exists:auctions,id',

            'csv_file' => [
                'required',
                'file',
                'mimes:csv,txt',
                'max:5120',
            ],
        ]);


        $file = $request->file('csv_file');

        $fileName = $file->getClientOriginalName();

        $path = $file->getRealPath();

        $handle = fopen($path, 'r');

        if (!$handle) {

            return back()
                ->withErrors([
                    'csv_file' => 'Unable to read CSV file.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Read CSV Header
        |--------------------------------------------------------------------------
        */

        $header = fgetcsv($handle);

        if (!$header) {

            fclose($handle);

            return back()
                ->withErrors([
                    'csv_file' => 'CSV file is empty.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Remove BOM
        |--------------------------------------------------------------------------
        */

        $header[0] = preg_replace(
            '/^\xEF\xBB\xBF/',
            '',
            $header[0]
        );


        /*
        |--------------------------------------------------------------------------
        | Normalize Header
        |--------------------------------------------------------------------------
        */

        $header = array_map(
            fn ($value) => strtolower(trim($value)),
            $header
        );


        /*
        |--------------------------------------------------------------------------
        | Required Columns
        |--------------------------------------------------------------------------
        */

        $requiredColumns = [
            'lot_number',
            'title',
            'description',
            'starting_price',
            'current_bid',
            'status',
            'images',
        ];


        foreach ($requiredColumns as $column) {

            if (!in_array($column, $header)) {

                fclose($handle);

                return back()
                    ->withErrors([
                        'csv_file' =>
                            "Missing required column: {$column}"
                    ])
                    ->withInput();
            }
        }


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
            | Read Each CSV Row
            |--------------------------------------------------------------------------
            */

            while (($row = fgetcsv($handle)) !== false) {

                /*
                |--------------------------------------------------------------------------
                | Ignore Completely Empty Rows
                |--------------------------------------------------------------------------
                */

                if (
                    count($row) === 1 &&
                    trim($row[0]) === ''
                ) {
                    continue;
                }


                $totalRows++;


                /*
                |--------------------------------------------------------------------------
                | Make Sure Column Count Matches
                |--------------------------------------------------------------------------
                */

                if (count($row) !== count($header)) {

                    $failedRows++;

                    continue;
                }


                $data = array_combine(
                    $header,
                    $row
                );


                /*
                |--------------------------------------------------------------------------
                | Required Lot Data
                |--------------------------------------------------------------------------
                */

                if (
                    empty(trim($data['lot_number'] ?? '')) ||
                    empty(trim($data['title'] ?? ''))
                ) {

                    $failedRows++;

                    continue;
                }


                $lotNumber = trim(
                    $data['lot_number']
                );


                /*
                |--------------------------------------------------------------------------
                | Prevent Duplicate Lot Numbers
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
                | Validate Status
                |--------------------------------------------------------------------------
                */

                $status = strtolower(
                    trim($data['status'] ?? 'available')
                );


                if (!in_array($status, [
                    'available',
                    'sold',
                    'unsold'
                ])) {

                    $status = 'available';
                }


                /*
                |--------------------------------------------------------------------------
                | Create Lot
                |--------------------------------------------------------------------------
                */

                $lot = Lot::create([

                    'auction_id' =>
                        $request->auction_id,

                    'lot_number' =>
                        $lotNumber,

                    'title' =>
                        trim($data['title']),

                    'description' =>
                        !empty($data['description'])
                            ? trim($data['description'])
                            : null,

                    'starting_price' =>
                        is_numeric($data['starting_price'] ?? null)
                            ? $data['starting_price']
                            : 0,

                    'current_bid' =>
                        is_numeric($data['current_bid'] ?? null)
                            ? $data['current_bid']
                            : 0,

                    'status' =>
                        $status,

                    /*
                    |--------------------------------------------------------------------------
                    | Do NOT store imported images in old
                    | lots.image column.
                    |
                    | Images are stored in lot_images table.
                    |--------------------------------------------------------------------------
                    */

                    'image' => null,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Multiple Images
                |--------------------------------------------------------------------------
                |
                | CSV format:
                |
                | image1.jpg|image2.jpg|image3.jpg
                |
                */

                $images = trim(
                    $data['images'] ?? ''
                );


                if ($images !== '') {

                    /*
                    |--------------------------------------------------------------------------
                    | Split images using |
                    |--------------------------------------------------------------------------
                    */

                    $imageList = explode(
                        '|',
                        $images
                    );


                    foreach ($imageList as $image) {

                        $image = trim($image);


                        /*
                        |--------------------------------------------------------------------------
                        | Ignore Empty Image Names
                        |--------------------------------------------------------------------------
                        */

                        if ($image === '') {
                            continue;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Save Image
                        |--------------------------------------------------------------------------
                        */

                        LotImage::create([

                            'lot_id' =>
                                $lot->id,

                            'image' =>
                                $image,

                        ]);
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Successful Row
                |--------------------------------------------------------------------------
                */

                $successfulRows++;
            }


            fclose($handle);


            /*
            |--------------------------------------------------------------------------
            | Determine Import Status
            |--------------------------------------------------------------------------
            */

            if ($successfulRows === $totalRows) {

                $status = 'completed';

            } elseif ($successfulRows > 0) {

                $status = 'partial';

            } else {

                $status = 'failed';
            }


            /*
            |--------------------------------------------------------------------------
            | Save Import History
            |--------------------------------------------------------------------------
            */

            BulkImport::create([

                'auction_id' =>
                    $request->auction_id,

                'file_name' =>
                    $fileName,

                'total_rows' =>
                    $totalRows,

                'successful_rows' =>
                    $successfulRows,

                'failed_rows' =>
                    $failedRows,

                'status' =>
                    $status,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Commit
            |--------------------------------------------------------------------------
            */

            DB::commit();


            return redirect()
                ->route('bulk-imports.index')
                ->with(
                    'success',
                    "{$successfulRows} lots imported successfully. {$failedRows} rows failed."
                );


        } catch (Exception $e) {

            DB::rollBack();


            if (is_resource($handle)) {
                fclose($handle);
            }


            return back()
                ->withErrors([
                    'csv_file' =>
                        'Import failed: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }


    /**
     * Delete import history.
     */
    public function destroy(BulkImport $import)
    {
        $import->delete();

        return redirect()
            ->route('bulk-imports.index')
            ->with(
                'success',
                'Import record deleted successfully.'
            );
    }
}
