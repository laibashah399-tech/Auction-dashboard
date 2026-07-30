<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Auction Admin Dashboard</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Heroicons -->
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

    <!-- ================================= -->
    <!-- SIDEBAR -->
    <!-- ================================= -->

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-slate-800">

            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center mr-3">
                <i data-lucide="gavel" class="w-6 h-6"></i>
            </div>

            <div>
                <h1 class="text-lg font-bold">AuctionPro</h1>
                <p class="text-xs text-slate-400">Management System</p>
            </div>

        </div>


        <!-- Navigation -->

        <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-80px)]">

            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                Main Menu
            </p>

            <!-- Dashboard -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg bg-indigo-600 text-white">

                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                <span>Dashboard</span>

            </a>


            <!-- Auctions -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="gavel" class="w-5 h-5"></i>

                <span>Auctions</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    124
                </span>

            </a>


            <!-- Lots -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="package" class="w-5 h-5"></i>

                <span>Lots</span>

            </a>


            <!-- Imports -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="upload-cloud" class="w-5 h-5"></i>

                <span>Bulk Imports</span>

                <span class="ml-auto bg-orange-500 text-xs px-2 py-1 rounded-full">
                    3
                </span>

            </a>


            <!-- Media -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="images" class="w-5 h-5"></i>

                <span>Media Library</span>

            </a>


            <!-- Live Bidding -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

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

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="users" class="w-5 h-5"></i>

                <span>Bidders</span>

            </a>


            <!-- Sellers -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="user-round" class="w-5 h-5"></i>

                <span>Sellers</span>

            </a>


            <!-- Payments -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="credit-card" class="w-5 h-5"></i>

                <span>Payments</span>

                <span class="ml-auto text-xs bg-red-500 px-2 py-1 rounded-full">
                    18
                </span>

            </a>


            <!-- Fulfillment -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="truck" class="w-5 h-5"></i>

                <span>Shipping & Pickup</span>

            </a>


            <!-- Reports -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="bar-chart-3" class="w-5 h-5"></i>

                <span>Reports</span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                System
            </p>


            <!-- Users -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="shield-check" class="w-5 h-5"></i>

                <span>Users & Roles</span>

            </a>


            <!-- Notifications -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="bell" class="w-5 h-5"></i>

                <span>Notifications</span>

            </a>


            <!-- Settings -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="settings" class="w-5 h-5"></i>

                <span>Settings</span>

            </a>


            <!-- Audit -->

            <a href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="file-clock" class="w-5 h-5"></i>

                <span>Audit Logs</span>

            </a>

        </nav>

    </aside>


    <!-- ================================= -->
    <!-- MAIN CONTENT -->
    <!-- ================================= -->

    <div class="flex-1 lg:ml-64">


        <!-- ================================= -->
        <!-- TOP NAVBAR -->
        <!-- ================================= -->

        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 sticky top-0 z-40">

            <div class="flex items-center gap-4">

                <!-- Mobile Menu -->

                <button onclick="toggleSidebar()"
                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100">

                    <i data-lucide="menu" class="w-6 h-6"></i>

                </button>


                <!-- Search -->

                <div class="hidden sm:flex items-center bg-gray-100 rounded-xl px-4 py-2.5 w-64 lg:w-96">

                    <i data-lucide="search"
                        class="w-5 h-5 text-gray-400 mr-2">
                    </i>

                    <input type="text"
                        placeholder="Search auctions, lots, bidders..."
                        class="bg-transparent outline-none w-full text-sm">

                </div>

            </div>


            <div class="flex items-center gap-3">


                <!-- Search Mobile -->

                <button class="sm:hidden p-2 hover:bg-gray-100 rounded-lg">

                    <i data-lucide="search"
                        class="w-5 h-5">
                    </i>

                </button>


                <!-- Notification -->

                <button class="relative p-2 hover:bg-gray-100 rounded-lg">

                    <i data-lucide="bell"
                        class="w-5 h-5">
                    </i>

                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full">
                    </span>

                </button>


                <!-- Profile -->

                <div class="flex items-center gap-3 border-l pl-4">

                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">
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


        <!-- ================================= -->
        <!-- PAGE CONTENT -->
        <!-- ================================= -->

        <main class="p-4 sm:p-6 lg:p-8">


            <!-- PAGE HEADER -->

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

                <div>

                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        Dashboard
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Welcome back! Here's what's happening with your auctions.
                    </p>

                </div>


                <div class="flex gap-3">

                    <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl hover:bg-gray-50">

                        <i data-lucide="download"
                            class="w-4 h-4">
                        </i>

                        Export

                    </button>


                    <button class="flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">

                        <i data-lucide="plus"
                            class="w-4 h-4">
                        </i>

                        Create Auction

                    </button>

                </div>

            </div>


            <!-- ================================= -->
            <!-- STATISTICS CARDS -->
            <!-- ================================= -->

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">


                <!-- Total Auctions -->

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Auctions
                            </p>

                            <h3 class="text-3xl font-bold mt-2">
                                124
                            </h3>

                            <p class="text-sm text-green-600 mt-2 flex items-center gap-1">

                                <i data-lucide="trending-up"
                                    class="w-4 h-4">
                                </i>

                                12.5% this month

                            </p>

                        </div>


                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="gavel"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>


                <!-- Total Lots -->

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Lots
                            </p>

                            <h3 class="text-3xl font-bold mt-2">
                                12,540
                            </h3>

                            <p class="text-sm text-green-600 mt-2">
                                +842 this month
                            </p>

                        </div>


                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="package"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>


                <!-- Total Bids -->

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Bids
                            </p>

                            <h3 class="text-3xl font-bold mt-2">
                                45,320
                            </h3>

                            <p class="text-sm text-green-600 mt-2">
                                +18.2% this week
                            </p>

                        </div>


                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="radio"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>


                <!-- Revenue -->

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Sales
                            </p>

                            <h3 class="text-3xl font-bold mt-2">
                                £1.2M
                            </h3>

                            <p class="text-sm text-green-600 mt-2">
                                +15.4% this month
                            </p>

                        </div>


                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="pound-sterling"
                                class="w-6 h-6">
                            </i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================================= -->
            <!-- SECONDARY STATISTICS -->
            <!-- ================================= -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


                <div class="bg-white p-5 rounded-2xl border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="users"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Registered Bidders
                            </p>

                            <h3 class="text-2xl font-bold">
                                2,450
                            </h3>

                        </div>

                    </div>

                </div>


                <div class="bg-white p-5 rounded-2xl border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="check-circle"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Sold Lots
                            </p>

                            <h3 class="text-2xl font-bold">
                                8,420
                            </h3>

                        </div>

                    </div>

                </div>


                <div class="bg-white p-5 rounded-2xl border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 bg-red-100 text-red-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="clock"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Pending Payments
                            </p>

                            <h3 class="text-2xl font-bold">
                                18
                            </h3>

                        </div>

                    </div>

                </div>


                <div class="bg-white p-5 rounded-2xl border border-gray-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center">

                            <i data-lucide="image-off"
                                class="w-5 h-5">
                            </i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Missing Images
                            </p>

                            <h3 class="text-2xl font-bold">
                                126
                            </h3>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================================= -->
            <!-- CHART + AUCTION STATUS -->
            <!-- ================================= -->

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">


                <!-- SALES CHART -->

                <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 p-6">

                    <div class="flex justify-between items-center mb-6">

                        <div>

                            <h3 class="text-lg font-bold">
                                Sales Overview
                            </h3>

                            <p class="text-sm text-gray-500">
                                Auction sales performance
                            </p>

                        </div>


                        <select class="border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">

                            <option>Last 7 Days</option>

                            <option>Last 30 Days</option>

                            <option>Last 6 Months</option>

                        </select>

                    </div>


                    <div class="h-72">

                        <canvas id="salesChart"></canvas>

                    </div>

                </div>


                <!-- AUCTION STATUS -->

                <div class="bg-white rounded-2xl border border-gray-100 p-6">

                    <h3 class="text-lg font-bold">
                        Auction Status
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Current auction overview
                    </p>


                    <div class="space-y-5">


                        <!-- Live -->

                        <div>

                            <div class="flex justify-between mb-2">

                                <span class="flex items-center gap-2 text-sm">

                                    <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse">
                                    </span>

                                    Live Auctions

                                </span>

                                <span class="font-bold">
                                    12
                                </span>

                            </div>

                            <div class="w-full bg-gray-100 rounded-full h-2">

                                <div class="bg-red-500 h-2 rounded-full"
                                    style="width: 25%">
                                </div>

                            </div>

                        </div>


                        <!-- Upcoming -->

                        <div>

                            <div class="flex justify-between mb-2">

                                <span class="flex items-center gap-2 text-sm">

                                    <span class="w-3 h-3 bg-yellow-500 rounded-full">
                                    </span>

                                    Upcoming

                                </span>

                                <span class="font-bold">
                                    20
                                </span>

                            </div>

                            <div class="w-full bg-gray-100 rounded-full h-2">

                                <div class="bg-yellow-500 h-2 rounded-full"
                                    style="width: 40%">
                                </div>

                            </div>

                        </div>


                        <!-- Completed -->

                        <div>

                            <div class="flex justify-between mb-2">

                                <span class="flex items-center gap-2 text-sm">

                                    <span class="w-3 h-3 bg-green-500 rounded-full">
                                    </span>

                                    Completed

                                </span>

                                <span class="font-bold">
                                    92
                                </span>

                            </div>

                            <div class="w-full bg-gray-100 rounded-full h-2">

                                <div class="bg-green-500 h-2 rounded-full"
                                    style="width: 75%">
                                </div>

                            </div>

                        </div>


                        <!-- Draft -->

                        <div>

                            <div class="flex justify-between mb-2">

                                <span class="flex items-center gap-2 text-sm">

                                    <span class="w-3 h-3 bg-gray-400 rounded-full">
                                    </span>

                                    Drafts

                                </span>

                                <span class="font-bold">
                                    8
                                </span>

                            </div>

                            <div class="w-full bg-gray-100 rounded-full h-2">

                                <div class="bg-gray-400 h-2 rounded-full"
                                    style="width: 15%">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================================= -->
            <!-- LIVE AUCTIONS -->
            <!-- ================================= -->

            <div class="bg-white rounded-2xl border border-gray-100 mb-8">


                <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                    <div>

                        <h3 class="text-lg font-bold">
                            Live Auctions
                        </h3>

                        <p class="text-sm text-gray-500">
                            Monitor your active auctions
                        </p>

                    </div>


                    <button class="text-indigo-600 text-sm font-medium hover:text-indigo-800">
                        View All Auctions →
                    </button>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                    Auction
                                </th>

                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                    Lots
                                </th>

                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                    Bids
                                </th>

                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                    Sales
                                </th>

                                <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                    Status
                                </th>

                                <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">


                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">

                                            <i data-lucide="image"
                                                class="w-5 h-5 text-indigo-600">
                                            </i>

                                        </div>

                                        <div>

                                            <p class="font-semibold">
                                                Fine Art Collection
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                Ends in 02h 34m
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-4">
                                    520
                                </td>

                                <td class="px-6 py-4">
                                    2,340
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    £245,800
                                </td>

                                <td class="px-6 py-4">

                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-medium">

                                        <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse">
                                        </span>

                                        Live

                                    </span>

                                </td>

                                <td class="px-6 py-4 text-right">

                                    <button class="p-2 hover:bg-gray-100 rounded-lg">

                                        <i data-lucide="more-horizontal"
                                            class="w-5 h-5">
                                        </i>

                                    </button>

                                </td>

                            </tr>


                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">

                                            <i data-lucide="gem"
                                                class="w-5 h-5 text-purple-600">
                                            </i>

                                        </div>

                                        <div>

                                            <p class="font-semibold">
                                                Jewellery Auction
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                Ends in 05h 12m
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-4">
                                    320
                                </td>

                                <td class="px-6 py-4">
                                    1,850
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    £182,450
                                </td>

                                <td class="px-6 py-4">

                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-medium">

                                        <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse">
                                        </span>

                                        Live

                                    </span>

                                </td>

                                <td class="px-6 py-4 text-right">

                                    <button class="p-2 hover:bg-gray-100 rounded-lg">

                                        <i data-lucide="more-horizontal"
                                            class="w-5 h-5">
                                        </i>

                                    </button>

                                </td>

                            </tr>


                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">

                                            <i data-lucide="clock"
                                                class="w-5 h-5 text-orange-600">
                                            </i>

                                        </div>

                                        <div>

                                            <p class="font-semibold">
                                                Antique Collection
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                Starts tomorrow
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <td class="px-6 py-4">
                                    850
                                </td>

                                <td class="px-6 py-4">
                                    —
                                </td>

                                <td class="px-6 py-4">
                                    —
                                </td>

                                <td class="px-6 py-4">

                                    <span class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-full text-xs font-medium">
                                        Upcoming
                                    </span>

                                </td>

                                <td class="px-6 py-4 text-right">

                                    <button class="p-2 hover:bg-gray-100 rounded-lg">

                                        <i data-lucide="more-horizontal"
                                            class="w-5 h-5">
                                        </i>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- ================================= -->
            <!-- BOTTOM SECTION -->
            <!-- ================================= -->

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


                <!-- RECENT ACTIVITY -->

                <div class="bg-white rounded-2xl border border-gray-100">

                    <div class="p-6 border-b border-gray-100">

                        <h3 class="text-lg font-bold">
                            Recent Activity
                        </h3>

                        <p class="text-sm text-gray-500">
                            Latest system activity
                        </p>

                    </div>


                    <div class="p-6 space-y-6">


                        <div class="flex gap-4">

                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">

                                <i data-lucide="upload"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p class="text-sm font-medium">
                                    120 lots imported successfully
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Antique Collection · 10 minutes ago
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center">

                                <i data-lucide="gavel"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p class="text-sm font-medium">
                                    New bid placed on Lot #LOT-1001
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Current bid £2,500 · 15 minutes ago
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center">

                                <i data-lucide="images"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p class="text-sm font-medium">
                                    340 images matched automatically
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Fine Art Collection · 25 minutes ago
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">

                                <i data-lucide="user-plus"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <p class="text-sm font-medium">
                                    New bidder registration
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Bidder #BD-2045 · 1 hour ago
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- QUICK ACTIONS -->

                <div class="bg-white rounded-2xl border border-gray-100">

                    <div class="p-6 border-b border-gray-100">

                        <h3 class="text-lg font-bold">
                            Quick Actions
                        </h3>

                        <p class="text-sm text-gray-500">
                            Frequently used actions
                        </p>

                    </div>


                    <div class="p-6 grid grid-cols-2 gap-4">


                        <button class="p-5 border border-gray-200 rounded-xl hover:border-indigo-500 hover:bg-indigo-50 transition text-left">

                            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mb-3">

                                <i data-lucide="gavel"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <p class="font-semibold">
                                Create Auction
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Start a new auction
                            </p>

                        </button>


                        <button class="p-5 border border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition text-left">

                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-3">

                                <i data-lucide="upload-cloud"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <p class="font-semibold">
                                Import Lots
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Upload CSV or Excel
                            </p>

                        </button>


                        <button class="p-5 border border-gray-200 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition text-left">

                            <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-3">

                                <i data-lucide="images"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <p class="font-semibold">
                                Upload Images
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Match images to lots
                            </p>

                        </button>


                        <button class="p-5 border border-gray-200 rounded-xl hover:border-green-500 hover:bg-green-50 transition text-left">

                            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-3">

                                <i data-lucide="file-bar-chart"
                                    class="w-5 h-5">
                                </i>

                            </div>

                            <p class="font-semibold">
                                Generate Report
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                View auction results
                            </p>

                        </button>

                    </div>

                </div>

            </div>


        </main>

    </div>

</div>


<!-- ================================= -->
<!-- JAVASCRIPT -->
<!-- ================================= -->

<script>

    // Initialize Icons

    lucide.createIcons();


    // Sidebar Toggle

    function toggleSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        sidebar.classList.toggle(
            '-translate-x-full'
        );

    }


    // Sales Chart

    const ctx =
        document.getElementById(
            'salesChart'
        ).getContext('2d');


    new Chart(ctx, {

        type: 'line',

        data: {

            labels: [
                'Mon',
                'Tue',
                'Wed',
                'Thu',
                'Fri',
                'Sat',
                'Sun'
            ],

            datasets: [

                {

                    label: 'Auction Sales',

                    data: [
                        42000,
                        58000,
                        49000,
                        75000,
                        62000,
                        91000,
                        105000
                    ],

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
                                value.toLocaleString();

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

</script>

</body>
</html>
