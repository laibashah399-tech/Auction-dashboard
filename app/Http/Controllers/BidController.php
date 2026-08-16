<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Lot;
use App\Models\User;
use App\Notifications\SystemNotification;
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

        // Create the bid
        $bid = Bid::create([

            'lot_id' => $lot->id,

            'bidder_id' => $request->bidder_id,

            'amount' => $request->amount,

        ]);

        // Update current bid
        $lot->update([

            'current_bid' => $request->amount,

        ]);

        // ==========================================
        // AUTOMATIC ADMIN NOTIFICATION
        // ==========================================

        $admins = User::where('role', 'Admin')->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new SystemNotification(
                    'New Bid Placed',
                    'A new bid of Rs. ' .
                    number_format($bid->amount, 2) .
                    ' has been placed on lot #' .
                    $lot->id . '.',
                    'bid'
                )
            );

        }

        return back()->with(
            'success',
            'Bid placed successfully.'
        );
    }
}