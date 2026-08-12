
@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('page-heading', 'Reports & Analytics')

@section('page-description', 'View reports and analytics for your auction business.')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Reports & Analytics
            </h1>

            <p class="text-gray-500 mt-1">
                Complete overview of your auction business
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('dashboard') }}"
               class="px-4 py-2 bg-white border border-gray-300 rounded-lg
                      text-gray-700 hover:bg-gray-50 transition">
                ← Dashboard
            </a>

            <button onclick="window.print()"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg
                           hover:bg-indigo-700 transition">
                Print Report
            </button>

        </div>

    </div>


    {{-- FILTERS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-8">

        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Report Filters
        </h2>

        <form method="GET"
              action="{{ route('reports.index') }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Auction --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Auction
                </label>

                <select name="auction_id"
                        class="w-full rounded-lg border-gray-300
                               focus:border-indigo-500 focus:ring-indigo-500">

                    <option value="">
                        All Auctions
                    </option>

                    @foreach($auctions as $auction)

                        <option value="{{ $auction->id }}"
                            {{ $auctionId == $auction->id ? 'selected' : '' }}>

                            {{ $auction->name }}

                        </option>

                    @endforeach

                </select>
            </div>


            {{-- From --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    From Date
                </label>

                <input type="date"
                       name="date_from"
                       value="{{ $dateFrom }}"
                       class="w-full rounded-lg border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500">

            </div>


            {{-- To --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    To Date
                </label>

                <input type="date"
                       name="date_to"
                       value="{{ $dateTo }}"
                       class="w-full rounded-lg border-gray-300
                              focus:border-indigo-500 focus:ring-indigo-500">

            </div>


            {{-- Buttons --}}
            <div class="flex items-end gap-2">

                <button type="submit"
                        class="flex-1 px-4 py-2 bg-indigo-600
                               text-white rounded-lg hover:bg-indigo-700">
                    Apply
                </button>

                <a href="{{ route('reports.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700
                          rounded-lg hover:bg-gray-200">
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- SUMMARY CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

        {{-- Sales --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

            <p class="text-sm text-gray-500">
                Total Sales
            </p>

            <h2 class="text-2xl font-bold text-green-600 mt-2">
                ${{ number_format($totalSales, 2) }}
            </h2>

            <p class="text-xs text-gray-400 mt-2">
                Paid payments
            </p>

        </div>


        {{-- Auctions --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

            <p class="text-sm text-gray-500">
                Total Auctions
            </p>

            <h2 class="text-2xl font-bold text-indigo-600 mt-2">
                {{ number_format($totalAuctions) }}
            </h2>

        </div>


        {{-- Lots --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

            <p class="text-sm text-gray-500">
                Total Lots
            </p>

            <h2 class="text-2xl font-bold text-purple-600 mt-2">
                {{ number_format($totalLots) }}
            </h2>

            <p class="text-xs text-gray-400 mt-2">
                {{ $soldLots }} sold
            </p>

        </div>


        {{-- Bids --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">

            <p class="text-sm text-gray-500">
                Total Bids
            </p>

            <h2 class="text-2xl font-bold text-orange-600 mt-2">
                {{ number_format($totalBids) }}
            </h2>

            <p class="text-xs text-gray-400 mt-2">
                Average:
                ${{ number_format($averageBid, 2) }}
            </p>

        </div>

    </div>


    {{-- SECOND SUMMARY --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Registered Bidders</p>

            <p class="text-2xl font-bold text-gray-900 mt-2">
                {{ number_format($totalBidders) }}
            </p>
        </div>


        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Sellers</p>

            <p class="text-2xl font-bold text-gray-900 mt-2">
                {{ number_format($totalSellers) }}
            </p>
        </div>


        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Pending Payments</p>

            <p class="text-2xl font-bold text-yellow-600 mt-2">
                {{ number_format($pendingPayments) }}
            </p>

            <p class="text-xs text-gray-400 mt-2">
                ${{ number_format($pendingAmount, 2) }}
            </p>
        </div>


        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-sm text-gray-500">Paid Payments</p>

            <p class="text-2xl font-bold text-green-600 mt-2">
                {{ number_format($paidPayments) }}
            </p>
        </div>

    </div>


    {{-- CHARTS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        {{-- Auction Status --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-5">
                Auction Status
            </h2>

            <div class="h-72">
                <canvas id="auctionStatusChart"></canvas>
            </div>

        </div>


        {{-- Lot Status --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-5">
                Lot Performance
            </h2>

            <div class="h-72">
                <canvas id="lotStatusChart"></canvas>
            </div>

        </div>

    </div>


    {{-- MONTHLY SALES --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">

        <h2 class="text-lg font-semibold text-gray-800 mb-5">
            Monthly Sales - {{ now()->year }}
        </h2>

        <div class="h-80">
            <canvas id="monthlySalesChart"></canvas>
        </div>

    </div>


    {{-- TOP SELLING LOTS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">

        <div class="p-6 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-800">
                Top Selling Lots
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   text-gray-500 uppercase">
                            Lot
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   text-gray-500 uppercase">
                            Auction
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold
                                   text-gray-500 uppercase">
                            Bidder
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold
                                   text-gray-500 uppercase">
                            Sale Amount
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($topSellingLots as $payment)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $payment->lot->lot_number ?? 'N/A' }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $payment->lot->title ?? 'N/A' }}
                                </div>

                            </td>


                            <td class="px-6 py-4 text-sm text-gray-600">

                                {{ $payment->lot->auction->name ?? 'N/A' }}

                            </td>


                            <td class="px-6 py-4 text-sm text-gray-600">

                                {{ $payment->bidder->name ?? 'N/A' }}

                            </td>


                            <td class="px-6 py-4 text-right">

                                <span class="font-semibold text-green-600">
                                    ${{ number_format($payment->amount, 2) }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-6 py-8 text-center text-gray-500">

                                No sales found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- TOP BIDDERS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">

        <div class="p-6 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-800">
                Top Bidders
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                            Bidder
                        </th>

                        <th class="px-6 py-3 text-center text-xs
                                   font-semibold text-gray-500 uppercase">
                            Total Bids
                        </th>

                        <th class="px-6 py-3 text-right text-xs
                                   font-semibold text-gray-500 uppercase">
                            Total Bid Amount
                        </th>

                        <th class="px-6 py-3 text-right text-xs
                                   font-semibold text-gray-500 uppercase">
                            Highest Bid
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($topBidders as $row)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $row->bidder->name ?? 'Unknown' }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $row->bidder->email ?? '' }}
                                </div>

                            </td>


                            <td class="px-6 py-4 text-center">

                                <span class="px-3 py-1 rounded-full
                                             bg-indigo-100 text-indigo-700
                                             text-sm font-medium">

                                    {{ number_format($row->total_bids) }}

                                </span>

                            </td>


                            <td class="px-6 py-4 text-right font-semibold">

                                ${{ number_format($row->total_bid_amount, 2) }}

                            </td>


                            <td class="px-6 py-4 text-right font-semibold text-green-600">

                                ${{ number_format($row->highest_bid, 2) }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-6 py-8 text-center text-gray-500">

                                No bidder data available.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- PAYMENT REPORT --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-5">
                Payment Overview
            </h2>

            <div class="space-y-4">

                <div class="flex justify-between items-center">

                    <span class="text-gray-600">
                        Paid
                    </span>

                    <span class="font-semibold text-green-600">
                        {{ $paidPayments }}
                    </span>

                </div>

                <div class="flex justify-between items-center">

                    <span class="text-gray-600">
                        Pending
                    </span>

                    <span class="font-semibold text-yellow-600">
                        {{ $pendingPayments }}
                    </span>

                </div>

                <div class="flex justify-between items-center">

                    <span class="text-gray-600">
                        Failed / Cancelled
                    </span>

                    <span class="font-semibold text-red-600">
                        {{ $failedPayments }}
                    </span>

                </div>

            </div>

        </div>


        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-5">
                Payment Methods
            </h2>

            <div class="space-y-4">

                @forelse($paymentMethods as $method)

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="font-medium text-gray-800">
                                {{ $method->payment_method ?: 'Unknown' }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $method->total_payments }} payments
                            </p>

                        </div>

                        <p class="font-semibold text-green-600">
                            ${{ number_format($method->total_amount, 2) }}
                        </p>

                    </div>

                @empty

                    <p class="text-gray-500">
                        No payment data available.
                    </p>

                @endforelse

            </div>

        </div>

    </div>


    {{-- SHIPPING STATUS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">

        <h2 class="text-lg font-semibold text-gray-800 mb-5">
            Shipping & Pickup Status
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            @forelse($shippingStatus as $status => $total)

                <div class="bg-gray-50 rounded-lg p-4">

                    <p class="text-sm text-gray-500 capitalize">
                        {{ str_replace('_', ' ', $status) }}
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $total }}
                    </p>

                </div>

            @empty

                <p class="text-gray-500">
                    No shipping records available.
                </p>

            @endforelse

        </div>

    </div>


    {{-- AUCTION PERFORMANCE --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="p-6 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-800">
                Auction Performance
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                            Auction
                        </th>

                        <th class="px-6 py-3 text-center text-xs
                                   font-semibold text-gray-500 uppercase">
                            Status
                        </th>

                        <th class="px-6 py-3 text-center text-xs
                                   font-semibold text-gray-500 uppercase">
                            Lots
                        </th>

                        <th class="px-6 py-3 text-right text-xs
                                   font-semibold text-gray-500 uppercase">
                            Sales
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($auctionPerformance as $auction)

                        @php
                            $auctionSales = \App\Models\Payment::where('status', 'paid')
                                ->whereHas('lot', function ($query) use ($auction) {
                                    $query->where('auction_id', $auction->id);
                                })
                                ->sum('amount');
                        @endphp

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $auction->name }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                <span class="px-3 py-1 rounded-full text-xs
                                    {{ $auction->status === 'live'
                                        ? 'bg-green-100 text-green-700'
                                        : ($auction->status === 'completed'
                                            ? 'bg-blue-100 text-blue-700'
                                            : 'bg-gray-100 text-gray-700') }}">

                                    {{ ucfirst($auction->status) }}

                                </span>

                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $auction->lots_count }}
                            </td>

                            <td class="px-6 py-4 text-right font-semibold text-green-600">
                                ${{ number_format($auctionSales, 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-6 py-8 text-center text-gray-500">

                                No auctions found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- CHART JAVASCRIPT --}}
<script>

    // ------------------------------------------
    // Auction Status Chart
    // ------------------------------------------

    new Chart(
        document.getElementById('auctionStatusChart'),
        {
            type: 'doughnut',

            data: {
                labels: [
                    'Draft',
                    'Upcoming',
                    'Live',
                    'Completed'
                ],

                datasets: [{
                    data: [
                        {{ $auctionStatus['draft'] }},
                        {{ $auctionStatus['upcoming'] }},
                        {{ $auctionStatus['live'] }},
                        {{ $auctionStatus['completed'] }}
                    ]
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );


    // ------------------------------------------
    // Lot Status Chart
    // ------------------------------------------

    new Chart(
        document.getElementById('lotStatusChart'),
        {
            type: 'doughnut',

            data: {
                labels: [
                    'Sold',
                    'Unsold'
                ],

                datasets: [{
                    data: [
                        {{ $lotStatus['sold'] }},
                        {{ $lotStatus['unsold'] }}
                    ]
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );


    // ------------------------------------------
    // Monthly Sales Chart
    // ------------------------------------------

    const monthlySales = @json($monthlySales);

    const months = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
    ];

    const salesData = Array(12).fill(0);

    monthlySales.forEach(item => {

        salesData[item.month - 1] = Number(item.total);

    });


    new Chart(
        document.getElementById('monthlySalesChart'),
        {
            type: 'line',

            data: {

                labels: months,

                datasets: [{
                    label: 'Sales',

                    data: salesData,

                    tension: 0.3,

                    fill: true
                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {
                        beginAtZero: true
                    }

                }

            }

        }
    );

</script>

</body>
@endsection
