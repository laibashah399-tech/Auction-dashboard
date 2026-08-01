<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lots - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-slate-100">


<div class="min-h-screen">


    <!-- Top Header -->

    <header class="bg-white border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-6 py-5">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">


                <div>

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 bg-indigo-600 rounded-xl flex items-center justify-center">

                            <span class="text-white text-xl font-bold">
                                AP
                            </span>

                        </div>

                        <div>

                            <h1 class="text-2xl font-bold text-slate-800">
                                Lots
                            </h1>

                            <p class="text-sm text-slate-500">
                                Manage and monitor all auction lots
                            </p>

                        </div>

                    </div>

                </div>


                <div class="flex gap-3">

                    <a
                        href="{{ route('dashboard') }}"
                        class="px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50"
                    >
                        ← Dashboard
                    </a>


                    <a
                        href="{{ route('auctions.index') }}"
                        class="px-4 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700"
                    >
                        View Auctions
                    </a>

                </div>

            </div>

        </div>

    </header>



    <!-- Main Content -->

    <main class="max-w-7xl mx-auto px-6 py-8">


        <!-- Statistics -->

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

                <p class="text-sm text-slate-500">
                    Total Lots
                </p>

                <h2 class="text-3xl font-bold text-slate-800 mt-2">
                    {{ $lots->total() }}
                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    All registered lots
                </p>

            </div>



            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

                <p class="text-sm text-slate-500">
                    Available
                </p>

                <h2 class="text-3xl font-bold text-emerald-600 mt-2">

                    {{ \App\Models\Lot::where('status', 'available')->count() }}

                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    Ready for auction
                </p>

            </div>



            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

                <p class="text-sm text-slate-500">
                    Sold
                </p>

                <h2 class="text-3xl font-bold text-indigo-600 mt-2">

                    {{ \App\Models\Lot::where('status', 'sold')->count() }}

                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    Successfully sold
                </p>

            </div>



            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

                <p class="text-sm text-slate-500">
                    Unsold
                </p>

                <h2 class="text-3xl font-bold text-red-500 mt-2">

                    {{ \App\Models\Lot::where('status', 'unsold')->count() }}

                </h2>

                <p class="text-xs text-slate-400 mt-2">
                    Did not sell
                </p>

            </div>


        </div>



        <!-- Lots Table -->

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">


            <div class="px-6 py-5 border-b border-slate-100">

                <h2 class="text-lg font-bold text-slate-800">
                    All Auction Lots
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    View complete information about every lot
                </p>

            </div>



            <div class="overflow-x-auto">


                <table class="w-full text-left">


                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Lot
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Item
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Auction
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Starting Price
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Current Bid
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Bids
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">
                                Action
                            </th>

                        </tr>

                    </thead>



                    <tbody class="divide-y divide-slate-100">


                    @forelse($lots as $lot)


                        <tr class="hover:bg-slate-50 transition">


                            <!-- Lot Number -->

                            <td class="px-6 py-5">

                                <span class="font-bold text-indigo-600">
                                    #{{ $lot->lot_number }}
                                </span>

                            </td>



                            <!-- Item -->

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">


                                    @if($lot->image)

                                        <img
                                            src="{{ asset('storage/' . $lot->image) }}"
                                            class="w-12 h-12 rounded-lg object-cover"
                                        >

                                    @else

                                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">

                                            <span class="text-slate-400 text-xs">
                                                No Image
                                            </span>

                                        </div>

                                    @endif


                                    <div>

                                        <p class="font-semibold text-slate-800">
                                            {{ $lot->title }}
                                        </p>

                                        <p class="text-xs text-slate-500 max-w-xs truncate">
                                            {{ $lot->description }}
                                        </p>

                                    </div>

                                </div>

                            </td>



                            <!-- Auction -->

                            <td class="px-6 py-5">

                                @if($lot->auction)

                                    <a
                                        href="{{ route('auctions.show', $lot->auction) }}"
                                        class="text-indigo-600 font-medium hover:underline"
                                    >
                                        {{ $lot->auction->name }}
                                    </a>

                                @else

                                    <span class="text-slate-400">
                                        No Auction
                                    </span>

                                @endif

                            </td>



                            <!-- Starting Price -->

                            <td class="px-6 py-5">

                                <span class="font-medium text-slate-700">

                                    £{{ number_format($lot->starting_price, 2) }}

                                </span>

                            </td>



                            <!-- Current Bid -->

                            <td class="px-6 py-5">

                                <span class="font-bold text-slate-800">

                                    £{{ number_format($lot->current_bid, 2) }}

                                </span>

                            </td>



                            <!-- Bids -->

                            <td class="px-6 py-5">

                                <span class="bg-slate-100 px-3 py-1 rounded-full text-sm">

                                    {{ $lot->bids_count }}

                                </span>

                            </td>



                            <!-- Status -->

                            <td class="px-6 py-5">


                                @if($lot->status === 'sold')

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                        Sold
                                    </span>


                                @elseif($lot->status === 'available')

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                        Available
                                    </span>


                                @else

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        Unsold
                                    </span>

                                @endif


                            </td>



                            <!-- Action -->

                            <td class="px-6 py-5">

                                <a
                                    href="{{ route('lots.show', $lot) }}"
                                    class="inline-flex items-center px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition"
                                >
                                    View Details
                                </a>

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="8" class="px-6 py-16 text-center">

                                <div class="text-slate-400">

                                    <p class="text-lg font-semibold">
                                        No lots found
                                    </p>

                                    <p class="text-sm mt-1">
                                        There are currently no lots in the database.
                                    </p>

                                </div>

                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>

            </div>


            <!-- Pagination -->

            <div class="px-6 py-5 border-t border-slate-100">

                {{ $lots->links() }}

            </div>


        </div>


    </main>


</div>


</body>

</html>

