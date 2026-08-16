@extends('layouts.app')

@section('title', 'Create Auction')

@section('page-heading', 'Create Auction')

@section('page-description', 'Create a new auction in AuctionPro.')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">

        {{-- Heading --}}
        <div class="mb-8">

            <h1 class="text-2xl font-bold text-slate-800">
                Create New Auction
            </h1>

            <p class="text-slate-500 mt-1">
                Enter the auction information below.
            </p>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 p-4 rounded-xl">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Auction Form --}}
        <form
            action="{{ route('auctions.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Auction Name --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold mb-2">
                        Auction Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Spring Art & Antiques Auction"
                        required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl
                               focus:ring-2 focus:ring-indigo-500
                               focus:border-indigo-500 outline-none"
                    >

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Enter a detailed description of this auction..."
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl
                               focus:ring-2 focus:ring-indigo-500
                               focus:border-indigo-500 outline-none resize-none"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Auction Status
                    </label>

                    <select
                        name="status"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl
                               focus:ring-2 focus:ring-indigo-500
                               focus:border-indigo-500 outline-none"
                    >

                        <option
                            value="draft"
                            {{ old('status') == 'draft' ? 'selected' : '' }}
                        >
                            Draft
                        </option>

                        <option
                            value="upcoming"
                            {{ old('status', 'upcoming') == 'upcoming' ? 'selected' : '' }}
                        >
                            Upcoming
                        </option>

                        <option
                            value="live"
                            {{ old('status') == 'live' ? 'selected' : '' }}
                        >
                            Live
                        </option>

                        <option
                            value="completed"
                            {{ old('status') == 'completed' ? 'selected' : '' }}
                        >
                            Completed
                        </option>

                    </select>

                    @error('status')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Total Sales --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Total Sales
                    </label>

                    <div class="relative">

                        <span class="absolute left-4 top-1/2
                                     -translate-y-1/2 text-slate-500">
                            £
                        </span>

                        <input
                            type="number"
                            name="total_sales"
                            value="{{ old('total_sales', 0) }}"
                            step="0.01"
                            min="0"
                            class="w-full pl-9 pr-4 py-3 border border-slate-300 rounded-xl
                                   focus:ring-2 focus:ring-indigo-500
                                   focus:border-indigo-500 outline-none"
                        >

                    </div>

                    @error('total_sales')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Start Date --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Start Date & Time
                    </label>

                    <input
                        type="datetime-local"
                        name="start_at"
                        value="{{ old('start_at') }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl
                               focus:ring-2 focus:ring-indigo-500
                               focus:border-indigo-500 outline-none"
                    >

                    @error('start_at')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- End Date --}}
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        End Date & Time
                    </label>

                    <input
                        type="datetime-local"
                        name="end_at"
                        value="{{ old('end_at') }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl
                               focus:ring-2 focus:ring-indigo-500
                               focus:border-indigo-500 outline-none"
                    >

                    @error('end_at')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Images --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold mb-2">
                        Auction Images
                    </label>

                    <input
                        type="file"
                        name="images[]"
                        multiple
                        accept="image/*"
                        class="w-full border border-slate-300 rounded-xl
                               p-3 bg-white
                               focus:ring-2 focus:ring-indigo-500
                               outline-none"
                    >

                    <p class="text-sm text-slate-500 mt-2">
                        You can select one or more images for this auction.
                    </p>

                    @error('images')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('images.*')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex justify-end gap-3 mt-8">

                <a
                    href="{{ route('auctions.index') }}"
                    class="px-6 py-3 bg-slate-100 rounded-xl
                           hover:bg-slate-200
                           text-slate-700 font-medium"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white
                           rounded-xl hover:bg-indigo-700
                           font-medium"
                >
                    Create Auction
                </button>

            </div>

        </form>

    </div>

</div>

@endsection