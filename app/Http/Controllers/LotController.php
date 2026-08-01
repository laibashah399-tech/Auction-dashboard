<?php

namespace App\Http\Controllers;

use App\Models\Lot;

class LotController extends Controller
{
    /**
     * Display all lots.
     */
    public function index()
    {
        $lots = Lot::with('auction')
            ->withCount('bids')
            ->latest()
            ->paginate(10);

        return view('lots.index', compact('lots'));
    }


    /**
     * Display a single lot.
     */
    public function show(Lot $lot)
    {
        $lot->load([
            'auction',
            'bids.bidder'
        ]);

        return view('lots.show', compact('lot'));
    }
}

