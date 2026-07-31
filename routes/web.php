<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuctionController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [
    DashboardController::class,
    'index'
])->name('dashboard');

Route::resource('auctions', AuctionController::class);


