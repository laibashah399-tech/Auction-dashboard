@extends('layouts.app')

@section('title', 'Live Bidding')

@section('page-heading', 'Live Bidding')

@section('page-description', 'Monitor live auctions and place bids in real time.')

@section('content')

@if($lot)

<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-xl font-bold mb-4">
        Live Bidding
    </h2>

    <h3 class="font-semibold">
        {{ $lot->title }}
    </h3>

    <p>Current Bid</p>

    <p class="text-3xl font-bold text-indigo-600">
        £{{ number_format($lot->current_bid,2) }}
    </p>

    <p class="mt-3">
        Highest Bidder

        @if($lot->winner)

            {{ $lot->winner->name }}

        @else

            None

        @endif
    </p>

    <form action="{{ route('bids.store',$lot->id) }}" method="POST">

        @csrf

        <select
            name="bidder_id"
            class="border rounded p-2 w-full">

            @foreach($bidders as $bidder)

                <option value="{{ $bidder->id }}">

                    {{ $bidder->bidder_number }}
                    -
                    {{ $bidder->name }}

                </option>

            @endforeach

        </select>

        <input
            type="number"
            name="amount"
            step="0.01"
            class="border rounded p-2 w-full mt-3"
            placeholder="Enter Bid">

        <button
            class="mt-4 bg-indigo-600 text-white px-5 py-2 rounded">

            Place Bid

        </button>

    </form>

</div>

@else

<hr class="my-6">

<h3 class="font-bold text-lg mb-3">
Recent Bids
</h3>

<table class="w-full border">

    <thead>

        <tr class="bg-gray-100">

            <th class="p-2">Bidder</th>

            <th class="p-2">Amount</th>

            <th class="p-2">Time</th>

        </tr>

    </thead>

    <tbody>

    @forelse($lot->bids()->latest()->get() as $bid)

        <tr>

            <td class="p-2">

                {{ $bid->bidder->name }}

            </td>

            <td class="p-2">

                £{{ number_format($bid->amount,2) }}

            </td>

            <td class="p-2">

                {{ $bid->created_at->diffForHumans() }}

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="3" class="text-center p-4">

                No bids yet.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

<div class="bg-white rounded-xl shadow p-8 text-center">

    <h2 class="text-2xl font-bold">
        No Live Lot Available
    </h2>

    <p class="text-gray-500 mt-2">
        Create a lot and set its status to <strong>available</strong> to start live bidding.
    </p>

</div>

@endif

@endsection