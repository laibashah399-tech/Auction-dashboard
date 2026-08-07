<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Create Auction - AuctionPro</title>

<script src="https://cdn.tailwindcss.com"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    sidebar: '#0f172a',
                    primary: '#4f46e5'
                }
            }
        }
    }
</script>
```

</head>

<body class="bg-slate-100 text-slate-800">

<div class="min-h-screen flex">


<!-- Sidebar -->
<aside class="w-64 bg-slate-900 text-white hidden lg:flex flex-col">

    <!-- Logo -->
    <div class="h-20 flex items-center px-6 border-b border-slate-800">

        <div>
            <h1 class="text-xl font-bold">
                AuctionPro
            </h1>

            <p class="text-xs text-slate-400">
                Management System
            </p>
        </div>

    </div>


    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1">

        <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
            Main Menu
        </p>

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition">

            <span>📊</span>

            <span>Dashboard</span>

        </a>


        <a href="{{ route('auctions.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-600 text-white">

            <span>🔨</span>

            <span>Auctions</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition">

            <span>📦</span>

            <span>Lots</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition">

            <span>👥</span>

            <span>Bidders</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition">

            <span>💳</span>

            <span>Payments</span>

        </a>


        <p class="text-xs uppercase text-slate-500 font-semibold px-3 mt-8 mb-3">
            Management
        </p>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition">

            <span>📈</span>

            <span>Reports</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition">

            <span>⚙️</span>

            <span>Settings</span>

        </a>

    </nav>


    <!-- Admin -->
    <div class="p-4 border-t border-slate-800">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center font-bold">
                AD
            </div>

            <div>

                <p class="text-sm font-semibold">
                    Admin User
                </p>

                <p class="text-xs text-slate-400">
                    Super Administrator
                </p>

            </div>

        </div>

    </div>

</aside>


<!-- Main Content -->
<main class="flex-1 min-w-0">

    <!-- Top Header -->
    <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-8">

        <div class="lg:hidden">

            <h1 class="font-bold text-lg">
                AuctionPro
            </h1>

        </div>


        <div class="hidden md:flex items-center w-full max-w-md">

            <div class="relative w-full">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    🔍
                </span>

                <input
                    type="text"
                    placeholder="Search auctions, lots, bidders..."
                    class="w-full pl-11 pr-4 py-2.5 bg-slate-100 border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
                >

            </div>

        </div>


        <div class="flex items-center gap-4 ml-auto">

            <div class="text-right hidden sm:block">

                <p class="text-sm font-semibold">
                    Admin User
                </p>

                <p class="text-xs text-slate-500">
                    Super Administrator
                </p>

            </div>


            <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                AD
            </div>

        </div>

    </header>


    <!-- Page -->
    <div class="p-6 lg:p-8">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">

            <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">
                Dashboard
            </a>

            <span>/</span>

            <a href="{{ route('auctions.index') }}" class="hover:text-indigo-600">
                Auctions
            </a>

            <span>/</span>

            <span class="text-slate-800 font-medium">
                Create Auction
            </span>

        </div>


        <!-- Page Heading -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-900">
                Create New Auction
            </h1>

            <p class="text-slate-500 mt-2">
                Create a new auction and manage its details.
            </p>

        </div>


        <!-- Validation Errors -->
        @if ($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-5">

                <div class="flex gap-3">

                    <div class="text-red-600 text-xl">
                        ⚠
                    </div>

                    <div>

                        <h3 class="font-semibold text-red-800">
                            Please fix the following errors:
                        </h3>

                        <ul class="list-disc ml-5 mt-2 text-sm text-red-700">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        <!-- Form Layout -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


            <!-- Main Form -->
            <div class="xl:col-span-2">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">

                    <div class="p-6 border-b border-slate-200">

                        <h2 class="text-lg font-bold text-slate-900">
                            Auction Information
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Enter the basic information for your auction.
                        </p>

                    </div>

<form action="{{ route('auctions.store') }}" method="POST" enctype="multipart/form-data">
                    

                        @csrf


                        <div class="p-6 space-y-6">


                            <!-- Name -->
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Auction Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="e.g. Spring Art & Antiques Auction"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"
                                    required
                                >

                            </div>


                            <!-- Description -->
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Description
                                </label>

                                <textarea
                                    name="description"
                                    rows="5"
                                    placeholder="Enter a detailed description of this auction..."
                                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition resize-none"
                                >{{ old('description') }}</textarea>

                            </div>


                            <!-- Status + Sales -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Auction Status
                                    </label>

                                    <select
                                        name="status"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                    >

                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                            Draft
                                        </option>

                                        <option value="upcoming" {{ old('status', 'upcoming') == 'upcoming' ? 'selected' : '' }}>
                                            Upcoming
                                        </option>

                                        <option value="live" {{ old('status') == 'live' ? 'selected' : '' }}>
                                            Live
                                        </option>

                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>

                                    </select>

                                </div>


                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Total Sales
                                    </label>

                                    <div class="relative">

                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                                            £
                                        </span>

                                        <input
                                            type="number"
                                            name="total_sales"
                                            value="{{ old('total_sales', 0) }}"
                                            step="0.01"
                                            min="0"
                                            class="w-full pl-9 pr-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                        >

                                    </div>

                                </div>

                            </div>


                            <!-- Dates -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        Start Date & Time
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="start_at"
                                        value="{{ old('start_at') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                    >

                                </div>


                                <div>

                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                        End Date & Time
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="end_at"
                                        value="{{ old('end_at') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                    >
                                   

<!-- Multiple Images -->
<div>
    <label class="block text-sm font-semibold mb-2">
        Auction Images
    </label>

    <input
        type="file"
        name="images[]"
        multiple
        accept="image/*"
        class="w-full border rounded-xl p-3"
    >
</div>

    <p class="text-sm text-slate-500 mt-2">
        You can select one or more images for this auction.
    </p>

    @error('images')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror

    @error('images.*')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror

</div>

                                </div>

                            </div>


                        </div>


                        <!-- Buttons -->
                        <div class="px-6 py-5 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row justify-end gap-3">

                            <a
                                href="{{ route('auctions.index') }}"
                                class="px-6 py-3 rounded-xl border border-slate-300 bg-white text-slate-700 font-semibold text-center hover:bg-slate-100 transition"
                            >
                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow-sm"
                            >
                                Create Auction
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            <!-- Right Summary -->
            <div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <h2 class="text-lg font-bold text-slate-900">
                        Auction Summary
                    </h2>

                    <p class="text-sm text-slate-500 mt-1 mb-6">
                        Review your auction before creating it.
                    </p>


                    <div class="space-y-5">


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Status
                            </span>

                            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                Upcoming
                            </span>

                        </div>


                        <div class="border-t border-slate-100"></div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Total Sales
                            </span>

                            <span class="font-semibold">
                                £0.00
                            </span>

                        </div>


                        <div class="border-t border-slate-100"></div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Lots
                            </span>

                            <span class="font-semibold">
                                0
                            </span>

                        </div>


                        <div class="border-t border-slate-100"></div>


                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Bids
                            </span>

                            <span class="font-semibold">
                                0
                            </span>

                        </div>


                    </div>

                </div>


                <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-2xl p-6">

                    <div class="text-indigo-600 text-2xl mb-3">
                        💡
                    </div>

                    <h3 class="font-bold text-indigo-900">
                        Helpful Tip
                    </h3>

                    <p class="text-sm text-indigo-700 mt-2 leading-6">
                        Create your auction first, then add lots and bidders from the auction management section.
                    </p>
                    

                </div>

            </div>

        </div>

    </div>

</main>


</div>

</body>

</html>
