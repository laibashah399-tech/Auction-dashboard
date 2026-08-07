<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Bidder;

class LiveBiddingController extends Controller
{
    public function index()
    {
        $lot = Lot::with('winner')
            ->where('status', 'available')
            ->first();

        $bidders = Bidder::where('status', 'active')->get();

        return view('live-bidding.index', compact(
            'lot',
            'bidders'
        ));
    }
}