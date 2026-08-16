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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuditLogController;



Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

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


Route::get('/reports', [
    ReportController::class,
    'index'
])->name('reports.index');


// Route::resource('users', UserController::class);


Route::middleware('auth')->group(function () {

Route::resource('users', UserController::class);


    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.read-all');

    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])
        ->name('notifications.destroy-all');

        Route::get('/settings', [
        SettingsController::class,
        'index'
    ])->name('settings.index');

    Route::put('/settings', [
        SettingsController::class,
        'update'
    ])->name('settings.update');

       Route::get(
        '/audit-logs',
        [AuditLogController::class, 'index']
    )->name('audit-logs.index');

    Route::delete(
        '/audit-logs/{auditLog}',
        [AuditLogController::class, 'destroy']
    )->name('audit-logs.destroy');

    Route::delete(
        '/audit-logs',
        [AuditLogController::class, 'destroyAll']
    )->name('audit-logs.destroy-all');
});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


