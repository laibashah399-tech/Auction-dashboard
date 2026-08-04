@extends('layouts.app')

@section('title', 'Bulk Imports')

@section('page-heading')
Bulk Imports
@endsection

@section('page-description')
Import and manage lots using CSV files.
@endsection

@section('content')

<div>

{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Bulk Imports
        </h1>

        {{-- <p class="text-gray-500 mt-1">
            Import and manage lots using CSV files.
        </p> --}}
    </div>

    <a
        href="{{ route('bulk-imports.create') }}"
        class="inline-flex items-center justify-center bg-indigo-600 text-white px-5 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold"
    >
        + New Import
    </a>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="bg-green-100 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>

@endif


{{-- Error Messages --}}
@if($errors->any())

    <div class="bg-red-100 border border-red-200 text-red-700 p-4 rounded-lg mb-6">

        @foreach($errors->all() as $error)

            <p>{{ $error }}</p>

        @endforeach

    </div>

@endif


{{-- Statistics --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

    {{-- Total Imports --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

        <p class="text-gray-500 text-sm">
            Total Imports
        </p>

        <h2 class="text-3xl font-bold text-gray-800 mt-2">
            {{ $totalImports }}
        </h2>

    </div>


    {{-- Successful --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

        <p class="text-gray-500 text-sm">
            Successful
        </p>

        <h2 class="text-3xl font-bold text-green-600 mt-2">
            {{ $successfulImports }}
        </h2>

    </div>


    {{-- Partial --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

        <p class="text-gray-500 text-sm">
            Partial
        </p>

        <h2 class="text-3xl font-bold text-yellow-600 mt-2">
            {{ $partialImports }}
        </h2>

    </div>


    {{-- Failed --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">

        <p class="text-gray-500 text-sm">
            Failed
        </p>

        <h2 class="text-3xl font-bold text-red-600 mt-2">
            {{ $failedImports }}
        </h2>

    </div>

</div>


{{-- Import History --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

    {{-- Section Header --}}
    <div class="p-6 border-b border-gray-100">

        <h2 class="text-xl font-bold text-gray-800">
            Import History
        </h2>

        <p class="text-gray-500 text-sm mt-1">
            View all previously imported CSV files.
        </p>

    </div>


    {{-- Table --}}
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                        File Name
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                        Auction
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                        Total Rows
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                        Successful
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                        Failed
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($imports as $import)

                    <tr class="border-t border-gray-100 hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $import->file_name }}
                        </td>


                        <td class="px-6 py-4 text-gray-600">
                            {{ $import->auction->name ?? 'N/A' }}
                        </td>


                        <td class="px-6 py-4 text-gray-600">
                            {{ $import->total_rows }}
                        </td>


                        <td class="px-6 py-4 text-green-600 font-medium">
                            {{ $import->successful_rows }}
                        </td>


                        <td class="px-6 py-4 text-red-600 font-medium">
                            {{ $import->failed_rows }}
                        </td>


                        <td class="px-6 py-4">

                            @if($import->status === 'completed')

                                <span class="inline-flex px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                    Completed
                                </span>

                            @elseif($import->status === 'partial')

                                <span class="inline-flex px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                                    Partial
                                </span>

                            @else

                                <span class="inline-flex px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
                                    Failed
                                </span>

                            @endif

                        </td>


                        <td class="px-6 py-4">

                            <form
                                action="{{ route('bulk-imports.destroy', $import) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this import record?')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-16 text-gray-500"
                        >

                            <div class="flex flex-col items-center">

                                <div class="text-5xl mb-4">
                                    📂
                                </div>

                                <p class="text-lg font-semibold text-gray-700">
                                    No bulk imports found.
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    Start by importing lots using a CSV file.
                                </p>

                                <a
                                    href="{{ route('bulk-imports.create') }}"
                                    class="mt-5 px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition"
                                >
                                    + New Import
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($imports->hasPages())

        <div class="p-6 border-t border-gray-100">

            {{ $imports->links() }}

        </div>

    @endif

</div>


</div>

@endsection
