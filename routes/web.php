<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\BulkImportController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [
    DashboardController::class,
    'index'
])->name('dashboard');

Route::resource('auctions', AuctionController::class);

Route::get('/lots', [ LotController::class, 'index' ])->name('lots.index'); Route::get('/lots/{lot}', [ LotController::class, 'show' ])->name('lots.show');

Route::get('/bulk-imports', [
    BulkImportController::class,
    'index'
])->name('bulk-imports.index');


Route::get('/bulk-imports/create', [
    BulkImportController::class,
    'create'
])->name('bulk-imports.create');


Route::post('/bulk-imports', [
    BulkImportController::class,
    'store'
])->name('bulk-imports.store');


Route::delete('/bulk-imports/{import}', [
    BulkImportController::class,
    'destroy'
])->name('bulk-imports.destroy');


