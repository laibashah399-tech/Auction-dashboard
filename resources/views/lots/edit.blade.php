@extends('layouts.app')

@section('title', 'Edit Lot')

@section('page-heading', 'Edit Lot')

@section('page-description', 'Update lot information.')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Edit Lot
            </h1>

            <p class="text-gray-500 mt-1">
                Update information for {{ $lot->title }}
            </p>
        </div>

        <a
            href="{{ route('lots.show', $lot) }}"
            class="px-5 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition"
        >
            ← Back
        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-6 p-5 bg-red-50 border border-red-200 rounded-xl">

            <h3 class="font-semibold text-red-700 mb-2">
                Please fix the following errors:
            </h3>

            <ul class="list-disc ml-5 text-red-600">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-6 p-5 bg-green-50 border border-green-200 rounded-xl text-green-700">
            {{ session('success') }}
        </div>

    @endif


    {{-- Edit Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

        <form
            action="{{ route('lots.update', $lot) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            {{-- Auction --}}
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Auction
                </label>

                <select
                    name="auction_id"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                >

                    <option value="">
                        -- Select Auction --
                    </option>

                    @foreach($auctions as $auction)

                        <option
                            value="{{ $auction->id }}"
                            {{ old('auction_id', $lot->auction_id) == $auction->id ? 'selected' : '' }}
                        >
                            {{ $auction->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Lot Number --}}
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Lot Number
                </label>

                <input
                    type="text"
                    name="lot_number"
                    value="{{ old('lot_number', $lot->lot_number) }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                >

            </div>


            {{-- Title --}}
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Lot Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $lot->title) }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                >

            </div>


            {{-- Description --}}
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                >{{ old('description', $lot->description) }}</textarea>

            </div>


            {{-- Prices --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Starting Price (£)
                    </label>

                    <input
                        type="number"
                        name="starting_price"
                        step="0.01"
                        min="0"
                        value="{{ old('starting_price', $lot->starting_price) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                    >

                </div>


                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Current Bid (£)
                    </label>

                    <input
                        type="number"
                        name="current_bid"
                        step="0.01"
                        min="0"
                        value="{{ old('current_bid', $lot->current_bid) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                    >

                </div>

            </div>


            {{-- Status --}}
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status
                </label>

                <select
                    name="status"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                >

                    <option
                        value="available"
                        {{ old('status', $lot->status) === 'available' ? 'selected' : '' }}
                    >
                        Available
                    </option>

                    <option
                        value="sold"
                        {{ old('status', $lot->status) === 'sold' ? 'selected' : '' }}
                    >
                        Sold
                    </option>

                    <option
                        value="unsold"
                        {{ old('status', $lot->status) === 'unsold' ? 'selected' : '' }}
                    >
                        Unsold
                    </option>

                </select>

            </div>


            {{-- Current Image --}}
            @if($lot->image)

                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Current Image
                    </label>

                    <img
                        src="{{ asset('storage/' . $lot->image) }}"
                        alt="{{ $lot->title }}"
                        class="w-48 h-48 object-cover rounded-xl border border-gray-200"
                    >

                </div>

            @endif


            {{-- New Image --}}
            <div class="mb-8">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Change Image
                </label>

                <input
                    type="file"
                    name="image"
                    accept="image/jpeg,image/png,image/webp"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white"
                >

                <p class="text-xs text-gray-500 mt-2">
                    Leave empty if you want to keep the current image.
                </p>

            </div>


            {{-- Buttons --}}
            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('lots.show', $lot) }}"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition"
                >
                    Cancel
                </a>
<form
    action="{{ route('lots.update', $lot) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')

               <button
    type="submit"
    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition"
>
    Update Lot
</button>

            </div>

        </form>

    </div>

</div>

@endsection