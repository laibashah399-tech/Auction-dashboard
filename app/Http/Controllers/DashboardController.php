<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Bidder;
use App\Models\Lot;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAuctions = Auction::count();

        $totalLots = Lot::count();

        $totalBids = Bid::count();

        $totalSales = Payment::where('status', 'paid')
            ->sum('amount');

        $registeredBidders = Bidder::count();

        $soldLots = Lot::where('status', 'sold')
            ->count();

        $pendingPayments = Payment::where('status', 'pending')
            ->count();

        $missingImages = Lot::whereNull('image')
            ->orWhere('image', '')
            ->count();

        $liveAuctions = Auction::where('status', 'live')
            ->withCount([
                'lots',
            ])
            ->with([
                'lots.bids',
            ])
            ->latest()
            ->get();

        $auctionStatus = [
            'live' => Auction::where('status', 'live')->count(),

            'upcoming' => Auction::where('status', 'upcoming')->count(),

            'completed' => Auction::where('status', 'completed')->count(),

            'draft' => Auction::where('status', 'draft')->count(),
        ];

        return view('dashboard', compact(
            'totalAuctions',
            'totalLots',
            'totalBids',
            'totalSales',
            'registeredBidders',
            'soldLots',
            'pendingPayments',
            'missingImages',
            'liveAuctions',
            'auctionStatus'
        ));
    }
}