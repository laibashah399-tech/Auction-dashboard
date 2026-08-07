@extends('layouts.app')

@section('title', 'Create Lot')

@section('page-heading', 'Create Lot')

@section('page-description', 'Add a new lot to an auction.')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Errors --}}
    @if($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">

            <h3 class="font-semibold mb-2">
                Please fix the following errors:
            </h3>

            <ul class="list-disc ml-5 text-sm">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

        {{-- Header --}}
        <div class="p-6 border-b border-slate-200">

            <div class="flex justify-between items-center">

                <div>

                    <h2 class="text-xl font-bold text-slate-800">
                        Create New Lot
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Add a new lot to your auction.
                    </p>

                </div>

                <a
                    href="{{ route('lots.index') }}"
                    class="px-4 py-2 bg-slate-100 rounded-lg hover:bg-slate-200"
                >
                    ← Back
                </a>

            </div>

        </div>


        {{-- Form --}}

        <form
            action="{{ route('lots.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="p-6 space-y-6">


                {{-- Auction --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Auction
                    </label>

                    <select
                        name="auction_id"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                        required
                    >

                        <option value="">
                            Select Auction
                        </option>

                        @foreach($auctions as $auction)

                            <option
                                value="{{ $auction->id }}"
                                {{ old('auction_id') == $auction->id ? 'selected' : '' }}
                            >
                                {{ $auction->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Lot Number --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Lot Number
                    </label>

                    <input
                        type="text"
                        name="lot_number"
                        value="{{ old('lot_number') }}"
                        placeholder="Example: LOT-1001"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                        required
                    >

                </div>


                {{-- Title --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Lot Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Example: Antique Wooden Chair"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                        required
                    >

                </div>


                {{-- Description --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Describe this lot..."
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                    >{{ old('description') }}</textarea>

                </div>


                {{-- Prices --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-semibold mb-2">
                            Starting Price (£)
                        </label>

                        <input
                            type="number"
                            name="starting_price"
                            value="{{ old('starting_price', 0) }}"
                            min="0"
                            step="0.01"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                            required
                        >

                    </div>


                    <div>

                        <label class="block text-sm font-semibold mb-2">
                            Current Bid (£)
                        </label>

                        <input
                            type="number"
                            name="current_bid"
                            value="{{ old('current_bid', 0) }}"
                            min="0"
                            step="0.01"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500"
                        >

                    </div>

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl"
                        required
                    >

                        <option
                            value="available"
                            {{ old('status', 'available') == 'available' ? 'selected' : '' }}
                        >
                            Available
                        </option>

                        <option
                            value="sold"
                            {{ old('status') == 'sold' ? 'selected' : '' }}
                        >
                            Sold
                        </option>

                        <option
                            value="unsold"
                            {{ old('status') == 'unsold' ? 'selected' : '' }}
                        >
                            Unsold
                        </option>

                    </select>

                </div>


                {{-- Image --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Lot Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl"
                    >

                    <p class="text-xs text-slate-500 mt-2">
                        JPG, PNG, GIF or WEBP. Maximum 5MB.
                    </p>

                </div>


            </div>


            {{-- Buttons --}}
            <div class="px-6 py-5 bg-slate-50 border-t flex justify-end gap-3">

                <a
                    href="{{ route('lots.index') }}"
                    class="px-6 py-3 border border-slate-300 bg-white rounded-xl font-semibold"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700"
                >
                    Create Lot
                </button>

            </div>

        </form>

    </div>

</div>

@endsection