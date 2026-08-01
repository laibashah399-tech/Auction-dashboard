@extends('layouts.app')

@section('content')

<div class="p-6 lg:p-8">

{{-- Header --}}
<div class="mb-8">

    <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">

        <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">
            Dashboard
        </a>

        <span>/</span>

        <a href="{{ route('bulk-imports.index') }}" class="hover:text-indigo-600">
            Bulk Imports
        </a>

        <span>/</span>

        <span>Create</span>

    </div>


    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Import Lots
            </h1>

            <p class="text-gray-500 mt-1">
                Upload a CSV file to add multiple lots to an auction.
            </p>

        </div>


        <a href="{{ route('bulk-imports.index') }}"
           class="px-5 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition">

            ← Back to Imports

        </a>

    </div>

</div>


{{-- Validation Errors --}}
@if($errors->any())

    <div class="mb-6 p-5 rounded-xl bg-red-50 border border-red-200">

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


<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


    {{-- Import Form --}}
    <div class="lg:col-span-2">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

            <div class="flex items-center gap-4 mb-8">

                <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl">
                    📥
                </div>

                <div>

                    <h2 class="text-xl font-bold text-gray-800">
                        Upload CSV File
                    </h2>

                    <p class="text-sm text-gray-500">
                        Select the auction and upload your lot data.
                    </p>

                </div>

            </div>


            <form action="{{ route('bulk-imports.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- Auction --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Select Auction
                    </label>

                    <select name="auction_id"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">

                        <option value="">
                            -- Select Auction --
                        </option>

                        @foreach($auctions as $auction)

                            <option value="{{ $auction->id }}"
                                {{ old('auction_id') == $auction->id ? 'selected' : '' }}>

                                {{ $auction->name }}

                            </option>

                        @endforeach

                    </select>

                    <p class="text-xs text-gray-500 mt-2">
                        All lots from the CSV file will be added to this auction.
                    </p>

                </div>


                {{-- File Upload --}}
                <div class="mb-8">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        CSV File
                    </label>

                    <label class="block border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center hover:border-indigo-400 hover:bg-indigo-50/30 transition cursor-pointer">

                        <div class="text-5xl mb-4">
                            📄
                        </div>

                        <h3 class="font-semibold text-gray-700">
                            Choose CSV File
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            CSV or TXT files only
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Maximum file size: 5MB
                        </p>

                        <input type="file"
                               name="csv_file"
                               accept=".csv,.txt"
                               required
                               class="hidden"
                               onchange="showFileName(this)">

                        <div id="file-name"
                             class="mt-4 text-sm font-semibold text-indigo-600">
                        </div>

                    </label>

                </div>


                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row justify-end gap-3">

                    <a href="{{ route('bulk-imports.index') }}"
                       class="px-6 py-3 text-center bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">

                        Cancel

                    </a>


                    <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition">

                        Import Lots

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- Instructions --}}
    <div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <h2 class="text-lg font-bold text-gray-800 mb-5">
                CSV Format
            </h2>


            <p class="text-sm text-gray-500 mb-5">
                Your CSV file must contain these columns:
            </p>


            <div class="space-y-3">

                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-mono text-sm text-indigo-600">
                        lot_number
                    </span>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-mono text-sm text-indigo-600">
                        title
                    </span>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-mono text-sm text-indigo-600">
                        description
                    </span>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-mono text-sm text-indigo-600">
                        starting_price
                    </span>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-mono text-sm text-indigo-600">
                        current_bid
                    </span>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-mono text-sm text-indigo-600">
                        status
                    </span>
                </div>

                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-mono text-sm text-indigo-600">
                        image
                    </span>
                </div>

            </div>

        </div>


        <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-2xl p-6">

            <h3 class="font-bold text-indigo-800 mb-3">
                Important
            </h3>

            <ul class="text-sm text-indigo-700 space-y-2">

                <li>• Lot number must be unique.</li>

                <li>• Title is required.</li>

                <li>• Duplicate lot numbers will be skipped.</li>

                <li>• Invalid rows will be marked as failed.</li>

                <li>• Maximum file size is 5MB.</li>

            </ul>

        </div>

    </div>

</div>
```

</div>

<script>

function showFileName(input) {

    const fileName = document.getElementById('file-name');

    if (input.files && input.files.length > 0) {

        fileName.textContent = 'Selected: ' + input.files[0].name;

    } else {

        fileName.textContent = '';

    }

}

</script>

@endsection
