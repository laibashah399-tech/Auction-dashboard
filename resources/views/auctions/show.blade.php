<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $auction->name }} - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- TOP BAR -->

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>

            <div class="flex items-center gap-3 mb-2">

                <a
                    href="{{ route('auctions.index') }}"
                    class="text-slate-500 hover:text-indigo-600"
                >
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>

                <span class="text-sm text-slate-500">
                    Auctions
                </span>

            </div>

            <h1 class="text-3xl font-bold text-slate-900">
                {{ $auction->name }}
            </h1>

            <p class="text-slate-500 mt-1">
                Auction details and lot management
            </p>

        </div>


        <div class="flex gap-3">

            <a
                href="{{ route('auctions.edit', $auction) }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700"
            >
                <i data-lucide="edit" class="w-4 h-4"></i>
                Edit Auction
            </a>

            <form
                action="{{ route('auctions.destroy', $auction) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this auction?')"
            >

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700"
                >
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    Delete
                </button>

            </form>

        </div>

    </div>


    <!-- SUCCESS MESSAGE -->

    @if(session('success'))

        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">

            {{ session('success') }}

        </div>

    @endif


    <!-- AUCTION SUMMARY -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-slate-500">
                        Status
                    </p>

                    <p class="text-2xl font-bold text-slate-900 mt-2">
                        {{ ucfirst($auction->status) }}
                    </p>

                </div>

                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">

                    <i data-lucide="gavel"></i>

                </div>

            </div>

        </div>


        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">

            <p class="text-sm text-slate-500">
                Total Lots
            </p>

            <p class="text-3xl font-bold text-slate-900 mt-2">
                {{ $auction->lots->count() }}
            </p>

        </div>


        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">

            <p class="text-sm text-slate-500">
                Total Sales
            </p>

            <p class="text-3xl font-bold text-slate-900 mt-2">
                £{{ number_format($auction->total_sales, 2) }}
            </p>

        </div>


        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">

            <p class="text-sm text-slate-500">
                Total Bids
            </p>

            <p class="text-3xl font-bold text-slate-900 mt-2">

                {{ $auction->lots->sum('bids_count') }}

            </p>

        </div>

    </div>


    <!-- AUCTION INFORMATION -->

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">

        <h2 class="text-xl font-bold text-slate-900 mb-5">
            Auction Information
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <p class="text-sm text-slate-500">
                    Description
                </p>

                <p class="text-slate-800 mt-1">
                    {{ $auction->description ?: 'No description provided.' }}
                </p>

            </div>


            <div>

                <p class="text-sm text-slate-500">
                    Start Date
                </p>

                <p class="text-slate-800 mt-1">

                    {{ $auction->start_at ? $auction->start_at->format('d M Y, h:i A') : 'Not set' }}

                </p>

            </div>


            <div>

                <p class="text-sm text-slate-500">
                    End Date
                </p>

                <p class="text-slate-800 mt-1">

                    {{ $auction->end_at ? $auction->end_at->format('d M Y, h:i A') : 'Not set' }}

                </p>

            </div>

        </div>

    </div>


    <!-- LOTS -->

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="p-6 border-b border-slate-200">

            <div class="flex justify-between items-center">

                <div>

                    <h2 class="text-xl font-bold text-slate-900">
                        Auction Lots
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        All lots belonging to this auction
                    </p>

                </div>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                            Lot
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                            Title
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                            Starting Price
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                            Current Bid
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                            Bids
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-600">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($auction->lots as $lot)

                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-5 font-semibold text-indigo-600">
                                #{{ $lot->lot_number }}
                            </td>

                            <td class="px-6 py-5">

                                <p class="font-semibold text-slate-900">
                                    {{ $lot->title }}
                                </p>

                                <p class="text-sm text-slate-500">
                                    {{ Str::limit($lot->description, 50) }}
                                </p>

                            </td>

                            <td class="px-6 py-5">

                                £{{ number_format($lot->starting_price, 2) }}

                            </td>

                            <td class="px-6 py-5 font-semibold">

                                £{{ number_format($lot->current_bid, 2) }}

                            </td>

                            <td class="px-6 py-5">

                                {{ $lot->bids_count }}

                            </td>

                            <td class="px-6 py-5">

                                @if($lot->status === 'sold')

                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Sold
                                    </span>

                                @elseif($lot->status === 'unsold')

                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Unsold
                                    </span>

                                @else

                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        Available
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-12 text-slate-500">

                                No lots found for this auction.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<script>
    lucide.createIcons();
</script>

</body>

</html>