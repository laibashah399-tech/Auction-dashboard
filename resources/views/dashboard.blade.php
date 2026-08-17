<!DOCTYPE html>
<html lang="en">

<style>
    /* Sidebar Scrollbar */
    #sidebar nav::-webkit-scrollbar {
        width: 8px;
    }

    #sidebar nav::-webkit-scrollbar-track {
        background: #020617;
    }

    #sidebar nav::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 10px;
    }

    #sidebar nav::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Auction Admin Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        sidebar: '#111827',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

    <!-- ===================================================== -->
    <!-- SIDEBAR -->
    <!-- ===================================================== -->

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 text-white
        transform -translate-x-full lg:translate-x-0
        transition-transform duration-300">

        <!-- Logo -->

        <div class="h-20 flex items-center px-6 border-b border-slate-800">

            <div class="w-10 h-10 bg-indigo-600 rounded-xl
                flex items-center justify-center mr-3">

                <i data-lucide="gavel" class="w-6 h-6"></i>

            </div>

            <div>

                <h1 class="text-lg font-bold">
                    AuctionPro
                </h1>

                <p class="text-xs text-slate-400">
                    Management System
                </p>

            </div>

        </div>


        <!-- Navigation -->

        <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-80px)]">

            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                Main Menu
            </p>


            <!-- Dashboard -->

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('dashboard')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                <span>Dashboard</span>

            </a>


            <!-- Auctions -->

            <a href="{{ route('auctions.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('auctions.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="gavel" class="w-5 h-5"></i>

                <span>Auctions</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ $totalAuctions }}
                </span>

            </a>


            <!-- Lots -->

            <a href="{{ route('lots.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('lots.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="package" class="w-5 h-5"></i>

                <span>Lots</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ $totalLots }}
                </span>

            </a>


            <!-- Bulk Imports -->

            <a href="{{ route('bulk-imports.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('bulk-imports.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="upload" class="w-5 h-5"></i>

                <span>Bulk Imports</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\BulkImport::count() }}
                </span>

            </a>


            <!-- Live Bidding -->

            <a href="{{ route('live-bidding.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('live-bidding.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="radio" class="w-5 h-5"></i>

                <span>Live Bidding</span>

                <span class="ml-auto flex items-center gap-1">

                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>

                    <span class="text-xs text-red-400">
                        LIVE
                    </span>

                </span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                Management
            </p>


            <!-- Bidders -->

            <a href="{{ route('bidders.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('bidders.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="users" class="w-5 h-5"></i>

                <span>Bidders</span>

            </a>


            <!-- Sellers -->

            <a href="{{ route('sellers.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('sellers.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="user-round" class="w-5 h-5"></i>

                <span>Sellers</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\Seller::count() }}
                </span>

            </a>


            <!-- Payments -->

            <a href="{{ route('payments.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('payments.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="credit-card" class="w-5 h-5"></i>

                <span>Payments</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\Payment::count() }}
                </span>

            </a>


            <!-- Shipping & Pickup -->

            <a href="{{ route('shipping-pickups.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('shipping-pickups.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="truck" class="w-5 h-5"></i>

                <span>Shipping & Pickup</span>

            </a>


            <!-- Reports -->

            <a href="{{ route('reports.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                {{ request()->routeIs('reports.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}
                transition">

                <i data-lucide="file-bar-chart" class="w-5 h-5"></i>

                <span>Reports</span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                System
            </p>


            <!-- Users -->

            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 px-3 py-3 
                text-slate-300">

                <i data-lucide="shield-check" class="w-5 h-5"></i>

                <span>Users & Roles</span>

            </a>


            <!-- Notifications -->

            <a href="{{ route('notifications.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="bell" class="w-5 h-5"></i>

                <span>Notifications</span>

            </a>


            <!-- Settings -->

            <a href="{{ route('settings.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="settings" class="w-5 h-5"></i>

                <span>Settings</span>

            </a>


            <!-- Audit Logs -->

            <a href="{{ route('audit-logs.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg
                text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="file-clock" class="w-5 h-5"></i>

                <span>Audit Logs</span>

            </a>

            <form action="{{ route('logout') }}" method="POST">
    @csrf

    <button
        type="submit"
        class="flex items-center gap-2 w-full px-4 py-3
               text-sm text-red-600
               hover:bg-red-50 rounded-lg">

        <i data-lucide="log-out" class="w-5 h-5"></i>

        Logout

    </button>

</form>

        </nav>

    </aside>


    <!-- ===================================================== -->
    <!-- MAIN CONTENT -->
    <!-- ===================================================== -->

    <div class="flex-1 lg:ml-64">


        <!-- ================================================= -->
        <!-- TOP NAVBAR -->
        <!-- ================================================= -->

        <header
            class="h-20 bg-white border-b border-gray-200
            flex items-center justify-between
            px-4 sm:px-6 lg:px-8
            sticky top-0 z-40">

            <div class="flex items-center gap-4">


                <!-- Mobile Menu -->

                <button
                    onclick="toggleSidebar()"
                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100">

                    <i data-lucide="menu" class="w-6 h-6"></i>

                </button>


                <!-- Search -->

                <div
                    class="hidden sm:flex items-center bg-gray-100
                    rounded-xl px-4 py-2.5
                    w-64 lg:w-96">

                    <i data-lucide="search"
                        class="w-5 h-5 text-gray-400 mr-2">
                    </i>

                  <form 
    action="{{ route('dashboard') }}" 
    method="GET" 
    class="w-full">

    <input 
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search auctions, lots, bidders, sellers..."
        class="bg-transparent outline-none w-full text-sm"
        autocomplete="off">

</form>
                </div>

            </div>


            <!-- Right Navbar -->

            <div class="flex items-center gap-3">


                <!-- Mobile Search -->

                <button
                    class="sm:hidden p-2 hover:bg-gray-100 rounded-lg">

                    <i data-lucide="search"
                        class="w-5 h-5">
                    </i>

                </button>


                <!-- Notification -->

                <button
                    class="relative p-2 hover:bg-gray-100 rounded-lg">

                    <i data-lucide="bell"
                        class="w-5 h-5">
                    </i>

                    <span
                        class="absolute top-1 right-1
                        w-2 h-2 bg-red-500 rounded-full">
                    </span>

                </button>


                <!-- Profile -->

                <div
                    class="flex items-center gap-3
                    border-l pl-4">

                    <div
                        class="w-10 h-10 bg-indigo-600
                        text-white rounded-full
                        flex items-center justify-center
                        font-bold">

                        AD

                    </div>

                    <div class="hidden md:block">

                        <p class="text-sm font-semibold">
                            Admin User
                        </p>

                        <p class="text-xs text-gray-500">
                            Super Administrator
                        </p>

                    </div>

                    <i data-lucide="chevron-down"
                        class="w-4 h-4 text-gray-500">
                    </i>

                </div>

            </div>

        </header>


        <!-- ================================================= -->
        <!-- PAGE CONTENT -->
        <!-- ================================================= -->

        <main class="p-4 sm:p-6 lg:p-8">
            {{-- ========================================================= --}}
{{-- SEARCH RESULTS --}}
{{-- ========================================================= --}}

@if(request('search'))

    <div class="mb-8 bg-white rounded-2xl border border-gray-100 shadow-sm">

        {{-- Search Header --}}
        <div class="p-6 border-b border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <h3 class="text-lg font-bold text-gray-900">
                        Search Results
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Results for:
                        <span class="font-semibold text-gray-700">
                            "{{ request('search') }}"
                        </span>
                    </p>

                </div>

                {{-- Clear Search --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">

                    Clear Search

                </a>

            </div>

        </div>


        {{-- Results --}}
        @if($searchResults->count() > 0)

            <div class="divide-y divide-gray-100">

                @foreach($searchResults as $result)

                    <a
                        href="{{ $result['url'] }}"
                        class="flex items-center justify-between p-5 hover:bg-gray-50 transition">

                        {{-- Left Side --}}
                        <div class="flex items-center gap-4">

                            {{-- Icon --}}
                            <div
                                class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">

                                @if($result['type'] === 'Auction')

                                    <i data-lucide="gavel" class="w-5 h-5"></i>

                                @elseif($result['type'] === 'Lot')

                                    <i data-lucide="package" class="w-5 h-5"></i>

                                @elseif($result['type'] === 'Bidder')

                                    <i data-lucide="users" class="w-5 h-5"></i>

                                @elseif($result['type'] === 'Seller')

                                    <i data-lucide="user-round" class="w-5 h-5"></i>

                                @elseif($result['type'] === 'Payment')

                                    <i data-lucide="credit-card" class="w-5 h-5"></i>

                                @elseif($result['type'] === 'Bulk Import')

                                    <i data-lucide="upload" class="w-5 h-5"></i>

                                @elseif($result['type'] === 'Shipping & Pickup')

                                    <i data-lucide="truck" class="w-5 h-5"></i>

                                @else

                                    <i data-lucide="user" class="w-5 h-5"></i>

                                @endif

                            </div>


                            {{-- Result Information --}}
                            <div>

                                <p class="font-semibold text-gray-900">
                                    {{ $result['title'] }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $result['description'] }}
                                </p>

                            </div>

                        </div>


                        {{-- Right Side --}}
                        <div class="flex items-center gap-3">

                            <span
                                class="text-xs font-medium px-3 py-1 rounded-full bg-gray-100 text-gray-600">

                                {{ $result['type'] }}

                            </span>

                            <i
                                data-lucide="chevron-right"
                                class="w-5 h-5 text-gray-400">
                            </i>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            {{-- No Results --}}
            <div class="p-10 text-center">

                <i
                    data-lucide="search-x"
                    class="w-10 h-10 mx-auto text-gray-300">
                </i>

                <p class="text-gray-600 font-medium mt-3">
                    No results found
                </p>

                <p class="text-sm text-gray-400 mt-1">
                    Try another search term.
                </p>

            </div>

        @endif

    </div>

@endif


            <!-- ================================================= -->
            <!-- PAGE HEADER -->
            <!-- ================================================= -->

            <div
                class="flex flex-col md:flex-row
                md:items-center md:justify-between
                gap-4 mb-8">

                <div>

                    <h2
                        class="text-2xl sm:text-3xl
                        font-bold text-gray-900">

                        Dashboard

                    </h2>

                    <p class="text-gray-500 mt-1">

                        Welcome back! Here's what's happening
                        with your auctions.

                    </p>

                </div>


                <div class="flex gap-3">

                    <a
                        href="{{ route('auctions.create') }}"
                        class="flex items-center gap-2
                        px-4 py-2.5
                        bg-indigo-600 text-white
                        rounded-xl hover:bg-indigo-700
                        transition">

                        <i data-lucide="plus"
                            class="w-4 h-4">
                        </i>

                        Create Auction

                    </a>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- MAIN STATISTICS -->
            <!-- ================================================= -->

            <div
                class="grid grid-cols-1
                sm:grid-cols-2
                xl:grid-cols-4
                gap-5 mb-8">


                <!-- Total Auctions -->

                <div
                    class="bg-white rounded-2xl p-5
                    border border-gray-100 shadow-sm">

                    <div
                        class="flex justify-between
                        items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Auctions
                            </p>

                            <h3
                                class="text-3xl font-bold mt-2">

                                {{ $totalAuctions }}

                            </h3>

                            <p
                                class="text-sm text-green-600
                                mt-2 flex items-center gap-1">

                                <i data-lucide="trending-up"
                                    class="w-4 h-4">
                                </i>

                                {{ $auctionsThisMonth }} this month

                            </p>

                        </div>

                        <div
                            class="w-12 h-12
                            bg-indigo-100
                            text-indigo-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="gavel"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>


                <!-- Total Lots -->

                <div
                    class="bg-white rounded-2xl p-5
                    border border-gray-100 shadow-sm">

                    <div
                        class="flex justify-between
                        items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Lots
                            </p>

                            <h3
                                class="text-3xl font-bold mt-2">

                                {{ $totalLots }}

                            </h3>

                            <p
                                class="text-sm text-green-600 mt-2">

                                +{{ $lotsThisMonth }} this month

                            </p>

                        </div>

                        <div
                            class="w-12 h-12
                            bg-blue-100
                            text-blue-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="package"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>


                <!-- Total Bids -->

                <div
                    class="bg-white rounded-2xl p-5
                    border border-gray-100 shadow-sm">

                    <div
                        class="flex justify-between
                        items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Bids
                            </p>

                            <h3
                                class="text-3xl font-bold mt-2">

                                {{ $totalBids }}

                            </h3>

                            <p
                                class="text-sm text-green-600 mt-2">

                                +{{ $bidsThisWeek }} this week

                            </p>

                        </div>

                        <div
                            class="w-12 h-12
                            bg-purple-100
                            text-purple-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="radio"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>


                <!-- Total Sales -->

                <div
                    class="bg-white rounded-2xl p-5
                    border border-gray-100 shadow-sm">

                    <div
                        class="flex justify-between
                        items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Sales
                            </p>

                            <h3
                                class="text-3xl font-bold mt-2">

                                £{{ number_format($totalSales, 2) }}

                            </h3>

                            <p
                                class="text-sm text-green-600 mt-2">

                                Paid sales

                            </p>

                        </div>

                        <div
                            class="w-12 h-12
                            bg-green-100
                            text-green-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="pound-sterling"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- SECONDARY STATISTICS -->
            <!-- ================================================= -->

            <div
                class="grid grid-cols-1
                sm:grid-cols-2
                lg:grid-cols-4
                gap-5 mb-8">


                <!-- Registered Bidders -->

                <div
                    class="bg-white p-5 rounded-2xl
                    border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div
                            class="w-11 h-11
                            bg-orange-100
                            text-orange-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="users"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Registered Bidders
                            </p>

                            <h3 class="text-2xl font-bold">
                                {{ $registeredBidders }}
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- Sold Lots -->

                <div
                    class="bg-white p-5 rounded-2xl
                    border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div
                            class="w-11 h-11
                            bg-green-100
                            text-green-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="check-circle"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Sold Lots
                            </p>

                            <h3 class="text-2xl font-bold">
                                {{ $soldLots }}
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- Pending Payments -->

                <div
                    class="bg-white p-5 rounded-2xl
                    border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div
                            class="w-11 h-11
                            bg-red-100
                            text-red-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="clock"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Pending Payments
                            </p>

                            <h3 class="text-2xl font-bold">
                                {{ $pendingPayments }}
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- Missing Images -->

                <div
                    class="bg-white p-5 rounded-2xl
                    border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div
                            class="w-11 h-11
                            bg-yellow-100
                            text-yellow-600
                            rounded-xl
                            flex items-center justify-center">

                            <i data-lucide="image-off"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Missing Images
                            </p>

                            <h3 class="text-2xl font-bold">
                                {{ $missingImages }}
                            </h3>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- SALES CHART + AUCTION STATUS -->
            <!-- ================================================= -->

            <div
                class="grid grid-cols-1
                xl:grid-cols-3
                gap-6 mb-8">


                <!-- SALES CHART -->

                <div
                    class="xl:col-span-2
                    bg-white rounded-2xl
                    border border-gray-100 p-6">

                    <div
                        class="flex justify-between
                        items-center mb-6">

                        <div>

                            <h3 class="text-lg font-bold">
                                Sales Overview
                            </h3>

                            <p class="text-sm text-gray-500">
                                Auction sales performance
                            </p>

                        </div>

                        <select
                            class="border border-gray-200
                            rounded-lg px-3 py-2
                            text-sm outline-none">

                            <option>
                                Last 7 Days
                            </option>

                            <option>
                                Last 30 Days
                            </option>

                            <option>
                                Last 6 Months
                            </option>

                        </select>

                    </div>

                    <div class="h-72">

                        <canvas id="salesChart"></canvas>

                    </div>

                </div>


                <!-- AUCTION STATUS -->

                <div
                    class="bg-white rounded-2xl
                    border border-gray-100 p-6">

                    <h3 class="text-lg font-bold">
                        Auction Status
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Current auction overview
                    </p>


                    <div class="space-y-5">


                        <!-- Live -->

                        <div>

                            <div
                                class="flex justify-between mb-2">

                                <span
                                    class="flex items-center gap-2 text-sm">

                                    <span
                                        class="w-3 h-3
                                        bg-red-500
                                        rounded-full
                                        animate-pulse">
                                    </span>

                                    Live Auctions

                                </span>

                                <span class="font-bold">

                                    {{ $auctionStatus['live'] }}

                                </span>

                            </div>

                            <div
                                class="w-full bg-gray-100
                                rounded-full h-2">

                                <div
                                    class="bg-red-500
                                    h-2 rounded-full
                                    transition-all"
                                    style="width: {{ $auctionStatusPercentages['live'] }}%">
                                </div>

                            </div>

                        </div>


                        <!-- Upcoming -->

                        <div>

                            <div
                                class="flex justify-between mb-2">

                                <span
                                    class="flex items-center gap-2 text-sm">

                                    <span
                                        class="w-3 h-3
                                        bg-yellow-500
                                        rounded-full">
                                    </span>

                                    Upcoming

                                </span>

                                <span class="font-bold">

                                    {{ $auctionStatus['upcoming'] }}

                                </span>

                            </div>

                            <div
                                class="w-full bg-gray-100
                                rounded-full h-2">

                                <div
                                    class="bg-yellow-500
                                    h-2 rounded-full
                                    transition-all"
                                    style="width: {{ $auctionStatusPercentages['upcoming'] }}%">
                                </div>

                            </div>

                        </div>


                        <!-- Completed -->

                        <div>

                            <div
                                class="flex justify-between mb-2">

                                <span
                                    class="flex items-center gap-2 text-sm">

                                    <span
                                        class="w-3 h-3
                                        bg-green-500
                                        rounded-full">
                                    </span>

                                    Completed

                                </span>

                                <span class="font-bold">

                                    {{ $auctionStatus['completed'] }}

                                </span>

                            </div>

                            <div
                                class="w-full bg-gray-100
                                rounded-full h-2">

                                <div
                                    class="bg-green-500
                                    h-2 rounded-full
                                    transition-all"
                                    style="width: {{ $auctionStatusPercentages['completed'] }}%">
                                </div>

                            </div>

                        </div>


                        <!-- Draft -->

                        <div>

                            <div
                                class="flex justify-between mb-2">

                                <span
                                    class="flex items-center gap-2 text-sm">

                                    <span
                                        class="w-3 h-3
                                        bg-gray-400
                                        rounded-full">
                                    </span>

                                    Drafts

                                </span>

                                <span class="font-bold">

                                    {{ $auctionStatus['draft'] }}

                                </span>

                            </div>

                            <div
                                class="w-full bg-gray-100
                                rounded-full h-2">

                                <div
                                    class="bg-gray-400
                                    h-2 rounded-full
                                    transition-all"
                                    style="width: {{ $auctionStatusPercentages['draft'] }}%">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- LIVE AUCTIONS -->
            <!-- ================================================= -->

            <div
                class="bg-white rounded-2xl
                border border-gray-100 mb-8">


                <!-- Header -->

                <div
                    class="p-6 border-b border-gray-100
                    flex flex-col sm:flex-row
                    sm:items-center
                    justify-between gap-4">

                    <div>

                        <h3 class="text-lg font-bold">
                            Live Auctions
                        </h3>

                        <p class="text-sm text-gray-500">
                            Monitor your active auctions
                        </p>

                    </div>


                    <a
                        href="{{ route('auctions.index') }}"
                        class="text-indigo-600
                        text-sm font-medium
                        hover:text-indigo-800">

                        View All Auctions →

                    </a>

                </div>


                <!-- Table -->

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th
                                    class="text-left px-6 py-4
                                    text-xs font-semibold
                                    text-gray-500 uppercase">

                                    Auction

                                </th>

                                <th
                                    class="text-left px-6 py-4
                                    text-xs font-semibold
                                    text-gray-500 uppercase">

                                    Lots

                                </th>

                                <th
                                    class="text-left px-6 py-4
                                    text-xs font-semibold
                                    text-gray-500 uppercase">

                                    Bids

                                </th>

                                <th
                                    class="text-left px-6 py-4
                                    text-xs font-semibold
                                    text-gray-500 uppercase">

                                    Sales

                                </th>

                                <th
                                    class="text-left px-6 py-4
                                    text-xs font-semibold
                                    text-gray-500 uppercase">

                                    Status

                                </th>

                                <th
                                    class="text-right px-6 py-4
                                    text-xs font-semibold
                                    text-gray-500 uppercase">

                                    Action

                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">


                            @forelse($liveAuctions as $auction)

                                <tr class="hover:bg-gray-50">


                                    <!-- Auction -->

                                    <td class="px-6 py-4">

                                        <div
                                            class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10
                                                bg-indigo-100
                                                rounded-lg
                                                flex items-center
                                                justify-center">

                                                <i
                                                    data-lucide="gavel"
                                                    class="w-5 h-5
                                                    text-indigo-600">
                                                </i>

                                            </div>


                                            <div>

                                                <p
                                                    class="font-semibold">

                                                    {{ $auction->name }}

                                                </p>

                                                <p
                                                    class="text-xs
                                                    text-gray-500">

                                                    @if($auction->end_at)

                                                        Ends
                                                        {{ $auction->end_at->diffForHumans() }}

                                                    @else

                                                        No end date

                                                    @endif

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    <!-- Lots -->

                                    <td class="px-6 py-4">

                                        {{ $auction->lots_count }}

                                    </td>


                                    <!-- Bids -->

                                    <td class="px-6 py-4">

                                        {{ $auction->lots->sum(function ($lot) {
                                            return $lot->bids->count();
                                        }) }}

                                    </td>


                                    <!-- Sales -->

                                    <td
                                        class="px-6 py-4
                                        font-semibold">

                                        £{{ number_format($auction->total_sales, 2) }}

                                    </td>


                                    <!-- Status -->

                                    <td class="px-6 py-4">

                                        <span
                                            class="inline-flex
                                            items-center gap-2
                                            px-3 py-1
                                            bg-red-50
                                            text-red-600
                                            rounded-full
                                            text-xs font-medium">

                                            <span
                                                class="w-2 h-2
                                                bg-red-500
                                                rounded-full
                                                animate-pulse">
                                            </span>

                                            Live

                                        </span>

                                    </td>


                                    <!-- Actions -->

                                    <td
                                        class="px-6 py-4
                                        text-right">

                                        <div
                                            class="flex
                                            items-center
                                            justify-end gap-2">


                                            <!-- View -->

                                            <a
                                                href="{{ route('auctions.show', $auction->id) }}"
                                                class="p-2 rounded-lg
                                                text-gray-500
                                                hover:text-indigo-600
                                                hover:bg-indigo-50
                                                transition"
                                                title="View Auction">

                                                <i
                                                    data-lucide="eye"
                                                    class="w-5 h-5">
                                                </i>

                                            </a>


                                            <!-- Edit -->

                                            <a
                                                href="{{ route('auctions.edit', $auction->id) }}"
                                                class="p-2 rounded-lg
                                                text-gray-500
                                                hover:text-indigo-600
                                                hover:bg-gray-100
                                                transition"
                                                title="Edit Auction">

                                                <i
                                                    data-lucide="edit"
                                                    class="w-5 h-5">
                                                </i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="px-6 py-10
                                        text-center
                                        text-gray-500">

                                        No live auctions found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- BOTTOM SECTION -->
            <!-- ================================================= -->

            <div
                class="grid grid-cols-1
                xl:grid-cols-2
                gap-6">


                <!-- ================================================= -->
                <!-- RECENT ACTIVITY -->
                <!-- ================================================= -->

                <div
                    class="bg-white rounded-2xl
                    border border-gray-100">


                    <div
                        class="p-6 border-b
                        border-gray-100">

                        <h3 class="text-lg font-bold">
                            Recent Activity
                        </h3>

                        <p class="text-sm text-gray-500">
                            Latest system activity
                        </p>

                    </div>


                    <div class="p-6 space-y-6">


                        <!-- Recent Imports -->

                        @foreach($recentImports as $import)

                            <div
                                class="flex gap-4">

                                <div
                                    class="w-10 h-10
                                    bg-blue-100
                                    text-blue-600
                                    rounded-full
                                    flex items-center
                                    justify-center
                                    shrink-0">

                                    <i
                                        data-lucide="upload"
                                        class="w-5 h-5">
                                    </i>

                                </div>


                                <div>

                                    <p
                                        class="text-sm
                                        font-medium">

                                        Bulk import completed

                                    </p>

                                    <p
                                        class="text-xs
                                        text-gray-500 mt-1">

                                        {{ $import->created_at->diffForHumans() }}

                                    </p>

                                </div>

                            </div>

                        @endforeach


                        <!-- Recent Bids -->

                        @foreach($recentBids as $bid)

                            <div
                                class="flex gap-4">

                                <div
                                    class="w-10 h-10
                                    bg-green-100
                                    text-green-600
                                    rounded-full
                                    flex items-center
                                    justify-center
                                    shrink-0">

                                    <i
                                        data-lucide="gavel"
                                        class="w-5 h-5">
                                    </i>

                                </div>


                                <div>

                                    <p
                                        class="text-sm
                                        font-medium">

                                        New bid placed

                                    </p>

                                    <p
                                        class="text-xs
                                        text-gray-500 mt-1">

                                        @if($bid->lot)

                                            Lot #{{ $bid->lot->lot_number }}

                                        @else

                                            Auction lot

                                        @endif

                                        · £{{ number_format($bid->amount ?? 0, 2) }}

                                        · {{ $bid->created_at->diffForHumans() }}

                                    </p>

                                </div>

                            </div>

                        @endforeach


                        <!-- Recent Bidders -->

                        @foreach($recentBidders as $bidder)

                            <div
                                class="flex gap-4">

                                <div
                                    class="w-10 h-10
                                    bg-orange-100
                                    text-orange-600
                                    rounded-full
                                    flex items-center
                                    justify-center
                                    shrink-0">

                                    <i
                                        data-lucide="user-plus"
                                        class="w-5 h-5">
                                    </i>

                                </div>


                                <div>

                                    <p
                                        class="text-sm
                                        font-medium">

                                        New bidder registration

                                    </p>

                                    <p
                                        class="text-xs
                                        text-gray-500 mt-1">

                                        {{ $bidder->name ?? 'New bidder' }}

                                        · {{ $bidder->created_at->diffForHumans() }}

                                    </p>

                                </div>

                            </div>

                        @endforeach


                        <!-- Empty State -->

                        @if(
                            $recentImports->isEmpty() &&
                            $recentBids->isEmpty() &&
                            $recentBidders->isEmpty()
                        )

                            <div
                                class="text-center py-8">

                                <i
                                    data-lucide="activity"
                                    class="w-8 h-8 mx-auto
                                    text-gray-300">
                                </i>

                                <p
                                    class="text-sm
                                    text-gray-500 mt-2">

                                    No recent activity.

                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                <!-- ================================================= -->
                <!-- QUICK ACTIONS -->
                <!-- ================================================= -->

                <div
                    class="bg-white rounded-2xl
                    border border-gray-100">


                    <div
                        class="p-6 border-b
                        border-gray-100">

                        <h3 class="text-lg font-bold">
                            Quick Actions
                        </h3>

                        <p class="text-sm text-gray-500">
                            Manage your auction system
                        </p>

                    </div>


                    <div
                        class="p-6 grid
                        grid-cols-1 sm:grid-cols-2
                        gap-4">


                        <!-- Create Auction -->

                        <a
                            href="{{ route('auctions.create') }}"
                            class="flex items-center gap-4
                            p-4 rounded-xl
                            border border-gray-100
                            hover:border-indigo-200
                            hover:bg-indigo-50
                            transition">

                            <div
                                class="w-11 h-11
                                bg-indigo-100
                                text-indigo-600
                                rounded-xl
                                flex items-center
                                justify-center">

                                <i
                                    data-lucide="plus"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p
                                    class="font-semibold">

                                    Create Auction

                                </p>

                                <p
                                    class="text-xs
                                    text-gray-500">

                                    Add new auction

                                </p>

                            </div>

                        </a>


                        <!-- Auctions -->

                        <a
                            href="{{ route('auctions.index') }}"
                            class="flex items-center gap-4
                            p-4 rounded-xl
                            border border-gray-100
                            hover:border-indigo-200
                            hover:bg-indigo-50
                            transition">

                            <div
                                class="w-11 h-11
                                bg-blue-100
                                text-blue-600
                                rounded-xl
                                flex items-center
                                justify-center">

                                <i
                                    data-lucide="gavel"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p class="font-semibold">
                                    Auctions
                                </p>

                                <p
                                    class="text-xs
                                    text-gray-500">

                                    Manage auctions

                                </p>

                            </div>

                        </a>


                        <!-- Lots -->

                        <a
                            href="{{ route('lots.index') }}"
                            class="flex items-center gap-4
                            p-4 rounded-xl
                            border border-gray-100
                            hover:border-indigo-200
                            hover:bg-indigo-50
                            transition">

                            <div
                                class="w-11 h-11
                                bg-purple-100
                                text-purple-600
                                rounded-xl
                                flex items-center
                                justify-center">

                                <i
                                    data-lucide="package"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p class="font-semibold">
                                    Lots
                                </p>

                                <p
                                    class="text-xs
                                    text-gray-500">

                                    Manage auction lots

                                </p>

                            </div>

                        </a>


                        <!-- Bulk Import -->

                        <a
                            href="{{ route('bulk-imports.index') }}"
                            class="flex items-center gap-4
                            p-4 rounded-xl
                            border border-gray-100
                            hover:border-indigo-200
                            hover:bg-indigo-50
                            transition">

                            <div
                                class="w-11 h-11
                                bg-green-100
                                text-green-600
                                rounded-xl
                                flex items-center
                                justify-center">

                                <i
                                    data-lucide="upload"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p class="font-semibold">
                                    Bulk Import
                                </p>

                                <p
                                    class="text-xs
                                    text-gray-500">

                                    Import lots from CSV

                                </p>

                            </div>

                        </a>


                    </div>

                </div>

            </div>

        </main>

    </div>

</div>


<!-- ===================================================== -->
<!-- JAVASCRIPT -->
<!-- ===================================================== -->

<script>

    /*
    |--------------------------------------------------------------------------
    | LUCIDE ICONS
    |--------------------------------------------------------------------------
    */

    lucide.createIcons();


    /*
    |--------------------------------------------------------------------------
    | SIDEBAR
    |--------------------------------------------------------------------------
    */

    function toggleSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        sidebar.classList.toggle('-translate-x-full');

    }


    /*
    |--------------------------------------------------------------------------
    | SALES CHART
    |--------------------------------------------------------------------------
    */

    const salesCanvas =
        document.getElementById('salesChart');


    if (salesCanvas) {

        const ctx =
            salesCanvas.getContext('2d');


        new Chart(ctx, {

            type: 'line',

            data: {

                labels: @json($salesChartLabels),

                datasets: [

                    {

                        label: 'Auction Sales',

                        data: @json($salesChartData),

                        borderWidth: 3,

                        fill: true,

                        tension: 0.4

                    }

                ]

            },


            options: {

                responsive: true,

                maintainAspectRatio: false,


                plugins: {

                    legend: {

                        display: false

                    }

                },


                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            callback: function(value) {

                                return '£' +
                                    Number(value).toLocaleString();

                            }

                        }

                    },


                    x: {

                        grid: {

                            display: false

                        }

                    }

                }

            }

        });

    }

</script>

</body>

</html>