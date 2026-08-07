<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Auction - AuctionPro</title>

<script src="https://cdn.tailwindcss.com"></script>
```

</head>

<body class="bg-slate-100 text-slate-800">

<div class="min-h-screen flex">

```
<!-- Sidebar -->
<aside class="w-64 bg-slate-900 text-white hidden lg:flex flex-col">

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


    <nav class="flex-1 p-4 space-y-1">

        <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
            Main Menu
        </p>


        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">

            📊
            <span>Dashboard</span>

        </a>


        <a href="{{ route('auctions.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-600">

            🔨
            <span>Auctions</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">

            📦
            <span>Lots</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">

            👥
            <span>Bidders</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">

            💳
            <span>Payments</span>

        </a>


        <p class="text-xs uppercase text-slate-500 font-semibold px-3 mt-8 mb-3">
            Management
        </p>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">

            📈
            <span>Reports</span>

        </a>


        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800">

            ⚙️
            <span>Settings</span>

        </a>

    </nav>


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


<!-- Main -->
<main class="flex-1 min-w-0">


    <!-- Header -->
    <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-8">

        <div class="hidden md:block w-full max-w-md">

            <div class="relative">

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


        <div class="flex items-center gap-3 ml-auto">

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


    <!-- Content -->
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
                Edit Auction
            </span>

        </div>


        <!-- Heading -->
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-slate-900">
                Edit Auction
            </h1>

            <p class="text-slate-500 mt-2">
                Update the details of this auction.
            </p>

        </div>


        @if ($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-5">

                <ul class="list-disc ml-5 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


            <!-- Form -->
            <div class="xl:col-span-2">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">


                    <div class="p-6 border-b border-slate-200">

                        <h2 class="text-lg font-bold">
                            Auction Information
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Update auction information below.
                        </p>

                    </div>


                    <form
                        action="{{ route('auctions.update', $auction) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <div class="p-6 space-y-6">


                            <!-- Name -->
                            <div>

                                <label class="block text-sm font-semibold mb-2">
                                    Auction Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $auction->name) }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                >

                            </div>


                            <!-- Description -->
                            <div>

                                <label class="block text-sm font-semibold mb-2">
                                    Description
                                </label>

                                <textarea
                                    name="description"
                                    rows="5"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none resize-none"
                                >{{ old('description', $auction->description) }}</textarea>

                            </div>


                            <!-- Status + Sales -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                                <div>

                                    <label class="block text-sm font-semibold mb-2">
                                        Auction Status
                                    </label>

                                    <select
                                        name="status"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                    >

                                        @foreach(['draft', 'upcoming', 'live', 'completed'] as $status)

                                            <option
                                                value="{{ $status }}"
                                                {{ old('status', $auction->status) == $status ? 'selected' : '' }}
                                            >

                                                {{ ucfirst($status) }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <div>

                                    <label class="block text-sm font-semibold mb-2">
                                        Total Sales
                                    </label>

                                    <div class="relative">

                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                                            £
                                        </span>

                                        <input
                                            type="number"
                                            name="total_sales"
                                            value="{{ old('total_sales', $auction->total_sales) }}"
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

                                    <label class="block text-sm font-semibold mb-2">
                                        Start Date & Time
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="start_at"
                                        value="{{ old('start_at', $auction->start_at ? $auction->start_at->format('Y-m-d\TH:i') : '') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                    >

                                </div>


                                <div>

                                    <label class="block text-sm font-semibold mb-2">
                                        End Date & Time
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="end_at"
                                        value="{{ old('end_at', $auction->end_at ? $auction->end_at->format('Y-m-d\TH:i') : '') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none"
                                    >

                                </div>

                            </div>

                        </div>
                        


                        <!-- Buttons -->
                        <div class="px-6 py-5 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row justify-between gap-3">


                            <a
                                href="{{ route('auctions.index') }}"
                                class="px-6 py-3 rounded-xl border border-slate-300 bg-white text-slate-700 font-semibold text-center hover:bg-slate-100"
                            >
                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700"
                            >
                                Update Auction
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            <!-- Summary -->
            <div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <h2 class="text-lg font-bold">
                        Auction Summary
                    </h2>

                    <p class="text-sm text-slate-500 mt-1 mb-6">
                        Current auction information.
                    </p>


                    <div class="space-y-5">


                        <div class="flex justify-between">

                            <span class="text-sm text-slate-500">
                                Auction ID
                            </span>

                            <span class="font-semibold">
                                #{{ $auction->id }}
                            </span>

                        </div>


                        <div class="border-t"></div>


                        <div class="flex justify-between">

                            <span class="text-sm text-slate-500">
                                Status
                            </span>

                            <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">

                                {{ ucfirst($auction->status) }}

                            </span>

                        </div>


                        <div class="border-t"></div>


                        <div class="flex justify-between">

                            <span class="text-sm text-slate-500">
                                Lots
                            </span>

                            <span class="font-semibold">
                                {{ $auction->lots()->count() }}
                            </span>

                        </div>


                        <div class="border-t"></div>


                        <div class="flex justify-between">

                            <span class="text-sm text-slate-500">
                                Total Sales
                            </span>

                            <span class="font-semibold">
                                £{{ number_format($auction->total_sales, 2) }}
                            </span>

                        </div>


                    </div>

                </div>


                <!-- Delete -->
                <div class="mt-6 bg-red-50 border border-red-200 rounded-2xl p-6">

                    <h3 class="font-bold text-red-800">
                        Delete Auction
                    </h3>

                    <p class="text-sm text-red-600 mt-2 mb-4">
                        Deleting this auction cannot be undone.
                    </p>


                    <form
                        action="{{ route('auctions.destroy', $auction) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to permanently delete this auction?')"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full px-4 py-3 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700"
                        >
                            Delete Auction
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</main>


</div>

</body>

</html>
