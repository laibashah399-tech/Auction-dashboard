@extends('layouts.app')

@section('title', 'Bidders')

@section('page-heading', 'Bidders')

@section('page-description', 'Manage and monitor all registered bidders.')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Bidders
            </h1>

            <p class="text-slate-500 mt-1">
                Manage registered bidders and their auction activity.
            </p>
        </div>

        <a href="{{ route('bidders.create') }}"
           class="inline-flex items-center justify-center gap-2
                  bg-indigo-600 text-white px-5 py-3 rounded-xl
                  font-semibold hover:bg-indigo-700 transition">

            <span class="text-xl">+</span>

            Add Bidder

        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="bg-green-50 border border-green-200
                    text-green-700 px-5 py-4 rounded-xl">

            {{ session('success') }}

        </div>

    @endif


    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

            <p class="text-sm text-slate-500">
                Total Bidders
            </p>

            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                {{ $totalBidders }}
            </h2>

        </div>


        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

            <p class="text-sm text-slate-500">
                Active Bidders
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                {{ $activeBidders }}
            </h2>

        </div>


        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

            <p class="text-sm text-slate-500">
                Inactive Bidders
            </p>

            <h2 class="text-3xl font-bold text-red-600 mt-2">
                {{ $inactiveBidders }}
            </h2>

        </div>


        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">

            <p class="text-sm text-slate-500">
                Total Bid Activity
            </p>

            <h2 class="text-3xl font-bold text-indigo-600 mt-2">
                {{ number_format($totalBids) }}
            </h2>

        </div>

    </div>


    {{-- Bidders Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h2 class="text-xl font-bold text-slate-800">
                Registered Bidders
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                View, edit, or delete bidder records.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Bidder
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Contact
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Bids
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Total Spent
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Status
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($bidders as $bidder)

                        <tr class="border-t border-slate-100 hover:bg-slate-50">

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-full
                                                bg-indigo-100 text-indigo-700
                                                flex items-center justify-center
                                                font-bold">

                                        {{ strtoupper(substr($bidder->name, 0, 2)) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-800">
                                            {{ $bidder->name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            {{ $bidder->bidder_number }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <p class="text-sm text-slate-700">
                                    {{ $bidder->email }}
                                </p>

                                <p class="text-xs text-slate-500">
                                    {{ $bidder->phone ?? 'No phone' }}
                                </p>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                {{ number_format($bidder->total_bids) }}
                            </td>


                            <td class="px-6 py-5 font-semibold">
                                £{{ number_format($bidder->total_spent, 2) }}
                            </td>


                            <td class="px-6 py-5">

                                @if($bidder->status === 'active')

                                    <span class="px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-green-100 text-green-700">

                                        Active

                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-red-100 text-red-700">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-2">

                                    <a href="{{ route('bidders.edit', $bidder) }}"
                                       class="px-3 py-2 rounded-lg
                                              bg-indigo-50 text-indigo-700
                                              hover:bg-indigo-100">

                                        Edit

                                    </a>


                                    <form action="{{ route('bidders.destroy', $bidder) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this bidder?')">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-2 rounded-lg
                                                       bg-red-50 text-red-700
                                                       hover:bg-red-100">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="px-6 py-12 text-center text-slate-500">

                                No bidders found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="p-6">

            {{ $bidders->links() }}

        </div>

    </div>

</div>

@endsection