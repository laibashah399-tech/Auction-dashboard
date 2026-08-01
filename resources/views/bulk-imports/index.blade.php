@extends('layouts.app')

@section('title', 'Bulk Imports')

@section('content')

<div class="p-6 lg:p-8">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">
                    Dashboard
                </a>

                <span>/</span>

                <span>Bulk Imports</span>
            </div>

            <h1 class="text-3xl font-bold text-gray-900">
                Bulk Imports
            </h1>

            <p class="text-gray-500 mt-1">
                Import auctions and lots using CSV or Excel files.
            </p>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

            <i data-lucide="check-circle" class="w-5 h-5"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- Error Messages --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5 text-red-700">

            <div class="flex items-center gap-2 font-semibold mb-2">

                <i data-lucide="alert-circle" class="w-5 h-5"></i>

                <span>
                    Import Failed
                </span>

            </div>

            <ul class="list-disc ml-6 text-sm space-y-1">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Import Cards --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">


        {{-- Import Lots --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

            <div class="flex items-center gap-4 mb-5">

                <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">

                    <i data-lucide="package" class="w-6 h-6 text-indigo-600"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Import Lots
                    </h2>

                    <p class="text-sm text-gray-500">
                        Upload multiple lots at once.
                    </p>

                </div>

            </div>


            <form action="{{ route('bulk-imports.lots') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-indigo-400 transition">

                    <i data-lucide="upload-cloud" class="w-10 h-10 mx-auto text-gray-400 mb-3"></i>

                    <p class="font-medium text-gray-700">
                        Upload Lots File
                    </p>

                    <p class="text-sm text-gray-500 mt-1 mb-5">
                        CSV or Excel file
                    </p>


                    <input
                        type="file"
                        name="lots_file"
                        accept=".csv,.xlsx,.xls"
                        required
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100"
                    >

                </div>


                <button
                    type="submit"
                    class="w-full mt-5 flex items-center justify-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition"
                >

                    <i data-lucide="upload" class="w-5 h-5"></i>

                    Import Lots

                </button>

            </form>

        </div>



        {{-- Import Auctions --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

            <div class="flex items-center gap-4 mb-5">

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">

                    <i data-lucide="gavel" class="w-6 h-6 text-purple-600"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Import Auctions
                    </h2>

                    <p class="text-sm text-gray-500">
                        Upload multiple auctions at once.
                    </p>

                </div>

            </div>


            <form action="{{ route('bulk-imports.auctions') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-purple-400 transition">

                    <i data-lucide="upload-cloud" class="w-10 h-10 mx-auto text-gray-400 mb-3"></i>

                    <p class="font-medium text-gray-700">
                        Upload Auctions File
                    </p>

                    <p class="text-sm text-gray-500 mt-1 mb-5">
                        CSV or Excel file
                    </p>


                    <input
                        type="file"
                        name="auctions_file"
                        accept=".csv,.xlsx,.xls"
                        required
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:bg-purple-50 file:text-purple-700
                        hover:file:bg-purple-100"
                    >

                </div>


                <button
                    type="submit"
                    class="w-full mt-5 flex items-center justify-center gap-2 px-5 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition"
                >

                    <i data-lucide="upload" class="w-5 h-5"></i>

                    Import Auctions

                </button>

            </form>

        </div>

    </div>



    {{-- Import Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


        <div class="bg-white rounded-2xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Imports
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900 mt-1">
                        24
                    </h3>

                </div>

                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">

                    <i data-lucide="database" class="w-5 h-5 text-blue-600"></i>

                </div>

            </div>

        </div>



        <div class="bg-white rounded-2xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Successful
                    </p>

                    <h3 class="text-2xl font-bold text-green-600 mt-1">
                        21
                    </h3>

                </div>

                <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center">

                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>

                </div>

            </div>

        </div>



        <div class="bg-white rounded-2xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Failed
                    </p>

                    <h3 class="text-2xl font-bold text-red-600 mt-1">
                        2
                    </h3>

                </div>

                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center">

                    <i data-lucide="x-circle" class="w-5 h-5 text-red-600"></i>

                </div>

            </div>

        </div>



        <div class="bg-white rounded-2xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Records Imported
                    </p>

                    <h3 class="text-2xl font-bold text-indigo-600 mt-1">
                        1,240
                    </h3>

                </div>

                <div class="w-11 h-11 bg-indigo-100 rounded-xl flex items-center justify-center">

                    <i data-lucide="layers" class="w-5 h-5 text-indigo-600"></i>

                </div>

            </div>

        </div>

    </div>



    {{-- Recent Import History --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-900">
                Recent Import History
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Latest bulk import activities.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                            File Name
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                            Type
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                            Records
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                            Status
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                            Date
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">


                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center">

                                    <i data-lucide="file-spreadsheet" class="w-5 h-5 text-indigo-600"></i>

                                </div>

                                <div>

                                    <p class="font-medium text-gray-900">
                                        antique-lots.csv
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Imported by Admin User
                                    </p>

                                </div>

                            </div>

                        </td>


                        <td class="px-6 py-5">
                            <span class="text-sm text-gray-700">
                                Lots
                            </span>
                        </td>


                        <td class="px-6 py-5">
                            <span class="text-sm text-gray-700">
                                120
                            </span>
                        </td>


                        <td class="px-6 py-5">

                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">

                                <i data-lucide="check" class="w-3 h-3"></i>

                                Completed

                            </span>

                        </td>


                        <td class="px-6 py-5 text-sm text-gray-500">
                            10 minutes ago
                        </td>

                    </tr>



                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">

                                    <i data-lucide="file-spreadsheet" class="w-5 h-5 text-purple-600"></i>

                                </div>

                                <div>

                                    <p class="font-medium text-gray-900">
                                        upcoming-auctions.xlsx
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Imported by Admin User
                                    </p>

                                </div>

                            </div>

                        </td>


                        <td class="px-6 py-5">
                            <span class="text-sm text-gray-700">
                                Auctions
                            </span>
                        </td>


                        <td class="px-6 py-5">
                            <span class="text-sm text-gray-700">
                                15
                            </span>
                        </td>


                        <td class="px-6 py-5">

                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">

                                <i data-lucide="check" class="w-3 h-3"></i>

                                Completed

                            </span>

                        </td>


                        <td class="px-6 py-5 text-sm text-gray-500">
                            1 hour ago
                        </td>

                    </tr>



                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-5">

                            <div class="flex