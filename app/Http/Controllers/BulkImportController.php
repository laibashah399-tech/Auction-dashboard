<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\BulkImport;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


        // Read CSV header
        $header = fgetcsv($handle);

        if (!$header) {
            fclose($handle);

            return back()
                ->withErrors([
                    'csv_file' => 'CSV file is empty.'
                ])
                ->withInput();
        }


        // Remove BOM if present
        $header[0] = preg_replace(
            '/^\xEF\xBB\xBF/',
            '',
            $header[0]
        );


        $header = array_map(
            fn ($value) => strtolower(trim($value)),
            $header
        );


        $requiredColumns = [
            'lot_number',
            'title',
            'description',
            'starting_price',
            'current_bid',
            'status',
            'image',
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


        $totalRows = 0;

        $successfulRows = 0;

        $failedRows = 0;


        DB::beginTransaction();


        try {

            while (($row = fgetcsv($handle)) !== false) {

                $totalRows++;


                if (count($row) !== count($header)) {

                    $failedRows++;

                    continue;
                }


                $data = array_combine(
                    $header,
                    $row
                );


                if (
                    empty($data['lot_number']) ||
                    empty($data['title'])
                ) {

                    $failedRows++;

                    continue;
                }


                $lotExists = Lot::where(
                    'lot_number',
                    trim($data['lot_number'])
                )->exists();


                if ($lotExists) {

                    $failedRows++;

                    continue;
                }


                Lot::create([

                    'auction_id' =>
                        $request->auction_id,

                    'lot_number' =>
                        trim($data['lot_number']),

                    'title' =>
                        trim($data['title']),

                    'description' =>
                        $data['description'] ?? null,

                    'starting_price' =>
                        is_numeric($data['starting_price'])
                            ? $data['starting_price']
                            : 0,

                    'current_bid' =>
                        is_numeric($data['current_bid'])
                            ? $data['current_bid']
                            : 0,

                    'status' =>
                        in_array(
                            $data['status'],
                            [
                                'available',
                                'sold',
                                'unsold'
                            ]
                        )
                            ? $data['status']
                            : 'available',

                    'image' =>
                        !empty($data['image'])
                            ? $data['image']
                            : null,
                ]);


                $successfulRows++;
            }


            fclose($handle);


            if ($successfulRows === $totalRows) {

                $status = 'completed';

            } elseif ($successfulRows > 0) {

                $status = 'partial';

            } else {

                $status = 'failed';
            }


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


            DB::commit();


            return redirect()
                ->route('imports.index')
                ->with(
                    'success',
                    "{$successfulRows} lots imported successfully. {$failedRows} rows failed."
                );


        } catch (\Exception $e) {

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