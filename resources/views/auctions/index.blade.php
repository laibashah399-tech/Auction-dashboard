@extends('layouts.app')


@section('title', 'Auctions - AuctionPro')


@section('page-heading', 'Auctions')


@section('page-description', 'Manage and monitor all your auctions.')


@section('content')


{{-- PAGE HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">


    <div>

        <h1 class="text-3xl font-bold text-slate-900">
            Auctions
        </h1>

        <p class="text-slate-500 mt-1">
            View, create, edit and manage your auctions.
        </p>

    </div>


    <a
        href="{{ route('auctions.create') }}"
        class="inline-flex items-center justify-center gap-2
        bg-indigo-600 text-white px-5 py-3 rounded-xl
        hover:bg-indigo-700 transition shadow-sm"
    >

        <i data-lucide="plus" class="w-5 h-5"></i>

        Create Auction

    </a>


</div>



{{-- SUMMARY CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


    {{-- Total Auctions --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">
                    Total Auctions
                </p>

                <h2 class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $auctions->total() }}
                </h2>

            </div>


            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">

                <i data-lucide="gavel" class="w-6 h-6"></i>

            </div>

        </div>

    </div>



    {{-- Current Page --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">
                    Current Page
                </p>

                <h2 class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $auctions->count() }}
                </h2>

            </div>


            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">

                <i data-lucide="list" class="w-6 h-6"></i>

            </div>

        </div>

    </div>



    {{-- Live Auctions --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">
                    Live Auctions
                </p>

                <h2 class="text-3xl font-bold text-slate-900 mt-2">

                    {{ \App\Models\Auction::where('status', 'live')->count() }}

                </h2>

            </div>


            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">

                <i data-lucide="radio" class="w-6 h-6"></i>

            </div>

        </div>

    </div>



    {{-- Upcoming Auctions --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-slate-500">
                    Upcoming
                </p>

                <h2 class="text-3xl font-bold text-slate-900 mt-2">

                    {{ \App\Models\Auction::where('status', 'upcoming')->count() }}

                </h2>

            </div>


            <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center">

                <i data-lucide="calendar-clock" class="w-6 h-6"></i>

            </div>

        </div>

    </div>


</div>



{{-- AUCTIONS TABLE --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


    {{-- TABLE HEADER --}}
    <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">


        <div>

            <h2 class="text-lg font-bold text-slate-900">
                All Auctions
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                View, edit, or delete your auctions.
            </p>

        </div>


        <div class="text-sm text-slate-500">

            Total:
            <span class="font-semibold text-slate-900">
                {{ $auctions->total() }}
            </span>

        </div>


    </div>



    {{-- TABLE --}}
    <div class="overflow-x-auto">


        <table class="w-full">


            <thead class="bg-slate-50 border-b border-slate-200">


                <tr>


                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase text-slate-500">
                        Auction
                    </th>


                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase text-slate-500">
                        Status
                    </th>


                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase text-slate-500">
                        Lots
                    </th>


                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase text-slate-500">
                        Sales
                    </th>


                    <th class="text-right px-6 py-4 text-xs font-semibold uppercase text-slate-500">
                        Actions
                    </th>


                </tr>


            </thead>



            <tbody class="divide-y divide-slate-100">


                @forelse($auctions as $auction)


                <tr class="hover:bg-slate-50 transition">


                    {{-- AUCTION --}}
                    <td class="px-6 py-5">


                        <div class="flex items-center gap-4">


                            <div class="w-11 h-11 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">

                                <i data-lucide="gavel" class="w-5 h-5"></i>

                            </div>


                            <div>

                                <p class="font-semibold text-slate-900">

                                    {{ $auction->name }}

                                </p>


                                <p class="text-sm text-slate-500 mt-1 max-w-md">

                                    {{ $auction->description ?: 'No description available.' }}

                                </p>


                                @if($auction->start_at)

                                    <p class="text-xs text-slate-400 mt-2">

                                        Starts:
                                        {{ $auction->start_at->format('d M Y, h:i A') }}

                                    </p>

                                @endif


                            </div>


                        </div>


                    </td>



                    {{-- STATUS --}}
                    <td class="px-6 py-5">


                        @if($auction->status === 'live')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>

                                Live

                            </span>


                        @elseif($auction->status === 'upcoming')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">

                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>

                                Upcoming

                            </span>


                        @elseif($auction->status === 'completed')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">

                                Completed

                            </span>


                        @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">

                                Draft

                            </span>

                        @endif


                    </td>



                    {{-- LOTS --}}
                   <td class="px-6 py-5">

    <a href="{{ route('auctions.show', $auction) }}"
       class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-semibold transition">

        <i data-lucide="package" class="w-4 h-4"></i>

        {{ $auction->lots_count }}

    </a>

</td>



                    {{-- SALES --}}
                    <td class="px-6 py-5">


                        <span class="font-semibold text-slate-900">

                            £{{ number_format($auction->total_sales, 2) }}

                        </span>


                    </td>



                    {{-- ACTIONS --}}
                    <td class="px-6 py-5">


                        <div class="flex items-center justify-end gap-2">


                            {{-- VIEW --}}
                            <a
                                href="{{ route('auctions.show', $auction) }}"
                                title="View Auction"
                                class="p-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition"
                            >

                                <i data-lucide="eye" class="w-4 h-4"></i>

                            </a>


                            {{-- EDIT --}}
                            <a
                                href="{{ route('auctions.edit', $auction) }}"
                                title="Edit Auction"
                                class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition"
                            >

                                <i data-lucide="pencil" class="w-4 h-4"></i>

                            </a>


                            {{-- DELETE --}}
                            <form
                                action="{{ route('auctions.destroy', $auction) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this auction?')"
                            >

                                @csrf

                                @method('DELETE')


                                <button
                                    type="submit"
                                    title="Delete Auction"
                                    class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition"
                                >

                                    <i data-lucide="trash-2" class="w-4 h-4"></i>

                                </button>


                            </form>


                        </div>


                    </td>


                </tr>


                @empty


                <tr>


                    <td colspan="5" class="px-6 py-16 text-center">


                        <div class="flex flex-col items-center">


                            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">

                                <i data-lucide="gavel" class="w-8 h-8 text-slate-400"></i>

                            </div>


                            <h3 class="text-lg font-semibold text-slate-900">
                                No auctions found
                            </h3>


                            <p class="text-slate-500 mt-1 mb-5">
                                Create your first auction to get started.
                            </p>


                            <a
                                href="{{ route('auctions.create') }}"
                                class="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition"
                            >

                                + Create Auction

                            </a>


                        </div>


                    </td>


                </tr>


                @endforelse


            </tbody>


        </table>


    </div>



    {{-- PAGINATION --}}
    @if($auctions->hasPages())


        <div class="px-6 py-5 border-t border-slate-200">

            {{ $auctions->links() }}

        </div>


    @endif


</div>


@endsection

