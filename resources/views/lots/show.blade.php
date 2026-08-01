<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $lot->title }} - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-slate-100">


<div class="min-h-screen">


    <!-- Header -->

    <header class="bg-white border-b border-slate-200">

        <div class="max-w-6xl mx-auto px-6 py-5">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-2xl font-bold text-slate-800">
                        Lot Details
                    </h1>

                    <p class="text-sm text-slate-500">
                        Complete information about this auction lot
                    </p>

                </div>


                <a
                    href="{{ route('lots.index') }}"
                    class="px-4 py-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200"
                >
                    ← Back to Lots
                </a>

            </div>

        </div>

    </header>



    <!-- Main -->

    <main class="max-w-6xl mx-auto px-6 py-8">


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            <!-- Image -->

            <div class="bg-white rounded-2xl shadow-sm p-6">


                @if($lot->image)

                    <img
                        src="{{ asset('storage/' . $lot->image) }}"
                        class="w-full h-80 object-cover rounded-xl"
                    >

                @else

                    <div class="w-full h-80 bg-slate-100 rounded-xl flex items-center justify-center">

                        <span class="text-slate-400">
                            No Image Available
                        </span>

                    </div>

                @endif


            </div>



            <!-- Details -->

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-8">


                <div class="flex justify-between items-start gap-4 mb-6">


                    <div>

                        <p class="text-sm text-indigo-600 font-semibold">
                            Lot #{{ $lot->lot_number }}
                        </p>

                        <h2 class="text-3xl font-bold text-slate-800 mt-1">
                            {{ $lot->title }}
                        </h2>

                    </div>


                    <span class="px-4 py-2 rounded-full text-sm font-semibold

                        @if($lot->status === 'sold')
                            bg-emerald-100 text-emerald-700
                        @elseif($lot->status === 'available')
                            bg-blue-100 text-blue-700
                        @else
                            bg-red-100 text-red-700
                        @endif
                    ">

                        {{ ucfirst($lot->status) }}

                    </span>


                </div>



                <div class="mb-8">

                    <h3 class="font-semibold text-slate-800 mb-2">
                        Description
                    </h3>

                    <p class="text-slate-600 leading-relaxed">

                        {{ $lot->description ?: 'No description available.' }}

                    </p>

                </div>



                <!-- Price Cards -->

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">


                    <div class="bg-slate-50 rounded-xl p-5">

                        <p class="text-sm text-slate-500">
                            Starting Price
                        </p>

                        <p class="text-2xl font-bold text-slate-800 mt-2">

                            £{{ number_format($lot->starting_price, 2) }}

                        </p>

                    </div>


                    <div class="bg-indigo-50 rounded-xl p-5">

                        <p class="text-sm text-indigo-600">
                            Current Bid
                        </p>

                        <p class="text-2xl font-bold text-indigo-700 mt-2">

                            £{{ number_format($lot->current_bid, 2) }}

                        </p>

                    </div>


                    <div class="bg-emerald-50 rounded-xl p-5">

                        <p class="text-sm text-emerald-600">
                            Total Bids
                        </p>

                        <p class="text-2xl font-bold text-emerald-700 mt-2">

                            {{ $lot->bids->count() }}

                        </p>

                    </div>


                </div>



                <!-- Auction -->

                <div class="border-t border-slate-100 pt-6">


                    <p class="text-sm text-slate-500 mb-1">
                        Associated Auction
                    </p>


                    @if($lot->auction)

                        <a
                            href="{{ route('auctions.show', $lot->auction) }}"
                            class="text-lg font-semibold text-indigo-600 hover:underline"
                        >
                            {{ $lot->auction->name }}
                        </a>

                    @else

                        <p class="text-slate-400">
                            No auction assigned
                        </p>

                    @endif


                </div>


            </div>


        </div>



        <!-- Bid History -->

        <div class="bg-white rounded-2xl shadow-sm mt-6 overflow-hidden">


            <div class="p-6 border-b border-slate-100">

                <h2 class="text-xl font-bold text-slate-800">
                    Bid History
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    All bids placed on this lot
                </p>

            </div>


            <div class="overflow-x-auto">


                <table class="w-full text-left">


                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-4">
                                Bidder
                            </th>

                            <th class="px-6 py-4">
                                Email
                            </th>

                            <th class="px-6 py-4">
                                Bid Amount
                            </th>

                            <th class="px-6 py-4">
                                Date
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">


                    @forelse($lot->bids->sortByDesc('amount') as $bid)


                        <tr>

                            <td class="px-6 py-4 font-medium">

                                {{ $bid->bidder->name ?? 'Unknown Bidder' }}

                            </td>


                            <td class="px-6 py-4 text-slate-500">

                                {{ $bid->bidder->email ?? '-' }}

                            </td>


                            <td class="px-6 py-4 font-bold text-indigo-600">

                                £{{ number_format($bid->amount, 2) }}

                            </td>


                            <td class="px-6 py-4 text-slate-500">

                                {{ $bid->created_at->format('d M Y, h:i A') }}

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">

                                No bids have been placed yet.

                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>

            </div>


        </div>


    </main>


</div>


</body>

</html>

