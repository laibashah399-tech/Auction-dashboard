<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Lot;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function store(Request $request, Lot $lot)
    {
        $request->validate([
            'bidder_id' => 'required|exists:bidders,id',
            'amount' => 'required|numeric|min:0'
        ]);

        if ($request->amount <= $lot->current_bid) {

            return back()->with(
                'error',
                'Bid must be greater than current bid.'
            );
        }

        Bid::create([

            'lot_id' => $lot->id,

            'bidder_id' => $request->bidder_id,

            'amount' => $request->amount,

        ]);

        $lot->update([

            'current_bid' => $request->amount,

        ]);

        return back()->with(
            'success',
            'Bid placed successfully.'
        );
    }
}