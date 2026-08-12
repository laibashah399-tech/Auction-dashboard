<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Bidder;
use App\Models\Lot;
use App\Models\Payment;
use App\Models\Seller;
use App\Models\ShippingPickup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // -------------------------------------------------
        // Filters
        // -------------------------------------------------
        $auctionId = $request->get('auction_id');
        $dateFrom  = $request->get('date_from');
        $dateTo    = $request->get('date_to');

        // -------------------------------------------------
        // Basic totals
        // -------------------------------------------------
        $totalAuctions = Auction::count();

        $totalLots = Lot::count();

        $totalBids = Bid::count();

        $totalBidders = Bidder::count();

        $totalSellers = Seller::count();

        $soldLots = Lot::where('status', 'sold')->count();

        $unsoldLots = Lot::where('status', '!=', 'sold')->count();

        // -------------------------------------------------
        // Sales
        // -------------------------------------------------
        $salesQuery = Payment::where('status', 'paid');

        if ($auctionId) {
            $salesQuery->whereHas('lot', function ($query) use ($auctionId) {
                $query->where('auction_id', $auctionId);
            });
        }

        if ($dateFrom) {
            $salesQuery->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $salesQuery->whereDate('created_at', '<=', $dateTo);
        }

        $totalSales = $salesQuery->sum('amount');

        // -------------------------------------------------
        // Payments
        // -------------------------------------------------
        $paidPayments = Payment::where('status', 'paid')->count();

        $pendingPayments = Payment::where('status', 'pending')->count();

        $failedPayments = Payment::whereIn('status', [
            'failed',
            'cancelled'
        ])->count();

        $pendingAmount = Payment::where('status', 'pending')
            ->sum('amount');

        // -------------------------------------------------
        // Average bid
        // -------------------------------------------------
        $averageBid = Bid::avg('amount') ?? 0;

        // -------------------------------------------------
        // Auction performance
        // -------------------------------------------------
        $auctionPerformanceQuery = Auction::withCount([
            'lots',
        ])->with([
            'lots' => function ($query) {
                $query->withCount('bids');
            }
        ]);

        if ($auctionId) {
            $auctionPerformanceQuery->where('id', $auctionId);
        }

        $auctionPerformance = $auctionPerformanceQuery
            ->latest()
            ->get();

        // -------------------------------------------------
        // Top selling lots
        // -------------------------------------------------
        $topSellingLotsQuery = Payment::with([
            'lot.auction',
            'bidder'
        ])
            ->where('status', 'paid')
            ->orderByDesc('amount');

        if ($auctionId) {
            $topSellingLotsQuery->whereHas('lot', function ($query) use ($auctionId) {
                $query->where('auction_id', $auctionId);
            });
        }

        if ($dateFrom) {
            $topSellingLotsQuery->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $topSellingLotsQuery->whereDate('created_at', '<=', $dateTo);
        }

        $topSellingLots = $topSellingLotsQuery
            ->limit(10)
            ->get();

        // -------------------------------------------------
        // Top bidders
        // -------------------------------------------------
        $topBidders = Bid::select(
            'bidder_id',
            DB::raw('COUNT(*) as total_bids'),
            DB::raw('SUM(amount) as total_bid_amount'),
            DB::raw('MAX(amount) as highest_bid')
        )
            ->with('bidder')
            ->groupBy('bidder_id')
            ->orderByDesc('total_bid_amount')
            ->limit(10)
            ->get();

        // -------------------------------------------------
        // Payment method report
        // -------------------------------------------------
        $paymentMethods = Payment::select(
            'payment_method',
            DB::raw('COUNT(*) as total_payments'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->where('status', 'paid')
            ->groupBy('payment_method')
            ->orderByDesc('total_amount')
            ->get();

        // -------------------------------------------------
        // Auction status report
        // -------------------------------------------------
        $auctionStatus = [
            'draft' => Auction::where('status', 'draft')->count(),
            'upcoming' => Auction::where('status', 'upcoming')->count(),
            'live' => Auction::where('status', 'live')->count(),
            'completed' => Auction::where('status', 'completed')->count(),
        ];

        // -------------------------------------------------
        // Lot status report
        // -------------------------------------------------
        $lotStatus = [
            'sold' => Lot::where('status', 'sold')->count(),
            'unsold' => Lot::where('status', '!=', 'sold')->count(),
        ];

        // -------------------------------------------------
        // Shipping report
        // -------------------------------------------------
        $shippingStatus = ShippingPickup::select(
            'status',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('status')
            ->pluck('total', 'status');

        // -------------------------------------------------
        // Monthly sales
        // -------------------------------------------------
        $monthlySales = Payment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        // -------------------------------------------------
        // Auctions for filter dropdown
        // -------------------------------------------------
        $auctions = Auction::orderBy('name')->get();

        return view('reports.index', compact(
            'totalAuctions',
            'totalLots',
            'totalBids',
            'totalBidders',
            'totalSellers',
            'soldLots',
            'unsoldLots',
            'totalSales',
            'paidPayments',
            'pendingPayments',
            'failedPayments',
            'pendingAmount',
            'averageBid',
            'auctionPerformance',
            'topSellingLots',
            'topBidders',
            'paymentMethods',
            'auctionStatus',
            'lotStatus',
            'shippingStatus',
            'monthlySales',
            'auctions',
            'auctionId',
            'dateFrom',
            'dateTo'
        ));
    }
}