<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Bidder;
use App\Models\Lot;
use App\Models\Payment;
use App\Models\BulkImport;
use App\Models\Seller;
use App\Models\ShippingPickup;
use App\Models\User;
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

        $search = trim($request->input('search', ''));

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
        | DASHBOARD GLOBAL SEARCH
        |--------------------------------------------------------------------------
        |
        | Search is now performed across:
        | Auctions
        | Lots
        | Bidders
        | Sellers
        | Payments
        | Bulk Imports
        | Shipping & Pickup
        | Users
        |
        */

        $searchResults = collect();

        if ($search !== '') {

            /*
            |----------------------------------------------------------------------
            | Auctions
            |----------------------------------------------------------------------
            */

            $auctionResults = Auction::where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Auction',
                        'title' => $item->name,
                        'description' => $item->status ?? 'Auction',
                        'url' => route('auctions.show', $item->id),
                    ];

                });

            $searchResults = $searchResults->merge($auctionResults);


            /*
            |----------------------------------------------------------------------
            | Lots
            |----------------------------------------------------------------------
            */

            $lotResults = Lot::where(function ($query) use ($search) {

                $query->where('lot_number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Lot',
                        'title' => 'Lot #' . $item->lot_number . ' - ' . $item->title,
                        'description' => $item->status ?? 'Lot',
                        'url' => route('lots.show', $item->id),
                    ];

                });

            $searchResults = $searchResults->merge($lotResults);


            /*
            |----------------------------------------------------------------------
            | Bidders
            |----------------------------------------------------------------------
            */

            $bidderResults = Bidder::where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Bidder',
                        'title' => $item->name,
                        'description' => $item->email ?? 'Bidder',
                        'url' => route('bidders.index'),
                    ];

                });

            $searchResults = $searchResults->merge($bidderResults);


            /*
            |----------------------------------------------------------------------
            | Sellers
            |----------------------------------------------------------------------
            */

            $sellerResults = Seller::where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Seller',
                        'title' => $item->name,
                        'description' => $item->email ?? 'Seller',
                        'url' => route('sellers.index'),
                    ];

                });

            $searchResults = $searchResults->merge($sellerResults);


            /*
            |----------------------------------------------------------------------
            | Payments
            |----------------------------------------------------------------------
            */

            $paymentResults = Payment::where(function ($query) use ($search) {

                $query->where('status', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search)
                        ->orWhere('amount', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Payment',
                        'title' => 'Payment #' . $item->id,
                        'description' => '£' . number_format($item->amount ?? 0, 2)
                            . ' - ' . ($item->status ?? ''),
                        'url' => route('payments.index'),
                    ];

                });

            $searchResults = $searchResults->merge($paymentResults);


            /*
            |----------------------------------------------------------------------
            | Bulk Imports
            |----------------------------------------------------------------------
            */

            $bulkImportResults = BulkImport::where(function ($query) use ($search) {

                $query->where('status', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Bulk Import',
                        'title' => 'Bulk Import #' . $item->id,
                        'description' => $item->status ?? 'Bulk Import',
                        'url' => route('bulk-imports.index'),
                    ];

                });

            $searchResults = $searchResults->merge($bulkImportResults);


            /*
            |----------------------------------------------------------------------
            | Shipping & Pickup
            |----------------------------------------------------------------------
            */

            $shippingResults = ShippingPickup::where(function ($query) use ($search) {

                $query->where('status', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Shipping & Pickup',
                        'title' => 'Shipping #' . $item->id,
                        'description' => $item->status ?? 'Shipping & Pickup',
                        'url' => route('shipping-pickups.index'),
                    ];

                });

            $searchResults = $searchResults->merge($shippingResults);


            /*
            |----------------------------------------------------------------------
            | Users
            |----------------------------------------------------------------------
            */

            $userResults = User::where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

            })
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'User',
                        'title' => $item->name,
                        'description' => $item->email ?? 'User',
                        'url' => route('users.index'),
                    ];

                });

            $searchResults = $searchResults->merge($userResults);


            /*
            |----------------------------------------------------------------------
            | Limit Results
            |----------------------------------------------------------------------
            */

            $searchResults = $searchResults->take(50);
        }


        /*
        |--------------------------------------------------------------------------
        | LIVE AUCTIONS
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Global search does NOT modify the normal Live Auctions section.
        | So your existing dashboard functionality remains unchanged.
        |
        */

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
            'searchResults',

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