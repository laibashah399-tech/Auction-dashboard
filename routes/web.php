<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\BulkImportController;
use App\Http\Controllers\BidderController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuctionImageController;
use App\Http\Controllers\LiveBiddingController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ShippingPickupController;



Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [
    DashboardController::class,
    'index'
])->name('dashboard');

Route::resource('auctions', AuctionController::class);

Route::resource('lots', LotController::class);

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

// Route::delete('/bulk-imports/{import}', [
//     BulkImportController::class,
//     'destroy'
// ])->name('bulk-imports.destroy');
Route::delete('/bulk-imports/{bulkImport}', [
    BulkImportController::class,
    'destroy'
])->name('bulk-imports.destroy');
Route::resource('bidders', BidderController::class)
    ->except(['show']);

    Route::resource(
    'payments',
    PaymentController::class
)->except([
    'show'
]);


Route::delete('/auction-images/{image}', [AuctionImageController::class, 'destroy'])
    ->name('auction-images.destroy');


    Route::post('/lots/{lot}/bid',[BidController::class,'store'])
    ->name('bids.store');


  Route::get('/live-bidding', [LiveBiddingController::class, 'index'])
    ->name('live-bidding.index');


    Route::resource('sellers', SellerController::class);

    

Route::resource('shipping-pickups', ShippingPickupController::class);