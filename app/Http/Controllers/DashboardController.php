<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Bidder;
use App\Models\Lot;
use App\Models\Payment;
use App\Models\BulkImport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        $search = $request->input('search');

        /*
        |--------------------------------------------------------------------------
        | MAIN STATISTICS
        |--------------------------------------------------------------------------
        */

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

        $missingImages = Lot::where(function ($query) {
            $query->whereNull('image')
                ->orWhere('image', '');
        })->count();


        /*
        |--------------------------------------------------------------------------
        | MONTHLY COUNTS
        |--------------------------------------------------------------------------
        */

        $startOfMonth = Carbon::now()->startOfMonth();

        $auctionsThisMonth = Auction::where(
            'created_at',
            '>=',
            $startOfMonth
        )->count();

        $lotsThisMonth = Lot::where(
            'created_at',
            '>=',
            $startOfMonth
        )->count();

        $bidsThisWeek = Bid::where(
            'created_at',
            '>=',
            Carbon::now()->startOfWeek()
        )->count();


        /*
        |--------------------------------------------------------------------------
        | LIVE AUCTIONS
        |--------------------------------------------------------------------------
        */

        $liveAuctionsQuery = Auction::where('status', 'live')
            ->withCount('lots')
            ->with([
                'lots.bids'
            ])
            ->latest();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD SEARCH
        |--------------------------------------------------------------------------
        */

        if ($search) {
            $liveAuctionsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('id', $search);
            });
        }

        $liveAuctions = $liveAuctionsQuery->get();


        /*
        |--------------------------------------------------------------------------
        | AUCTION STATUS
        |--------------------------------------------------------------------------
        */

        $auctionStatus = [
            'live' => Auction::where('status', 'live')->count(),

            'upcoming' => Auction::where('status', 'upcoming')->count(),

            'completed' => Auction::where('status', 'completed')->count(),

            'draft' => Auction::where('status', 'draft')->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | AUCTION STATUS TOTAL
        |--------------------------------------------------------------------------
        */

        $auctionStatusTotal = array_sum($auctionStatus);


        /*
        |--------------------------------------------------------------------------
        | STATUS PERCENTAGES
        |--------------------------------------------------------------------------
        */

        $auctionStatusPercentages = [];

        foreach ($auctionStatus as $status => $count) {

            $auctionStatusPercentages[$status] =
                $auctionStatusTotal > 0
                    ? round(($count / $auctionStatusTotal) * 100)
                    : 0;
        }


        /*
        |--------------------------------------------------------------------------
        | SALES CHART - LAST 7 DAYS
        |--------------------------------------------------------------------------
        */

        $salesChartLabels = [];

        $salesChartData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::today()->subDays($i);

            $salesChartLabels[] = $date->format('D');

            $salesChartData[] = (float) Payment::where('status', 'paid')
                ->whereDate('created_at', $date)
                ->sum('amount');
        }


        /*
        |--------------------------------------------------------------------------
        | RECENT BULK IMPORTS
        |--------------------------------------------------------------------------
        */

        $recentImports = BulkImport::latest()
            ->take(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RECENT BIDS
        |--------------------------------------------------------------------------
        */

        $recentBids = Bid::with([
            'lot'
        ])
            ->latest()
            ->take(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RECENT BIDDERS
        |--------------------------------------------------------------------------
        */

        $recentBidders = Bidder::latest()
            ->take(3)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(

            'search',

            'totalAuctions',
            'totalLots',
            'totalBids',
            'totalSales',

            'registeredBidders',
            'soldLots',
            'pendingPayments',
            'missingImages',

            'auctionsThisMonth',
            'lotsThisMonth',
            'bidsThisWeek',

            'liveAuctions',

            'auctionStatus',
            'auctionStatusTotal',
            'auctionStatusPercentages',

            'salesChartLabels',
            'salesChartData',

            'recentImports',
            'recentBids',
            'recentBidders'
        ));
    }
}