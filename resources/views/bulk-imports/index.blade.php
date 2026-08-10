@extends('layouts.app')

@section('title', 'Bulk Imports')

@section('content')

<div class="p-6 lg:p-8">

    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>

            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">

                <a
                    href="{{ route('dashboard') }}"
                    class="hover:text-indigo-600"
                >
                    Dashboard
                </a>

                <span>/</span>

                <span>Bulk Imports</span>

            </div>

            <h1 class="text-3xl font-bold text-gray-900">
                Bulk Imports
            </h1>

            <p class="text-gray-500 mt-1">
                Import multiple lots into an auction using CSV files.
            </p>

        </div>

        <a
            href="{{ route('bulk-imports.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition"
        >

            <i data-lucide="upload" class="w-5 h-5"></i>

            New Import

        </a>

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
    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5 text-red-700">

            <div class="flex items-center gap-2 font-semibold mb-2">

                <i data-lucide="alert-circle" class="w-5 h-5"></i>

                <span>
                    Delete / Import Error
                </span>

            </div>

            <ul class="list-disc ml-6 text-sm space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


        {{-- Total Imports --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Imports
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $totalImports ?? 0 }}
                    </h3>

                </div>

                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">

                    <i
                        data-lucide="database"
                        class="w-5 h-5 text-blue-600"
                    ></i>

                </div>

            </div>

        </div>


        {{-- Successful --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Successful
                    </p>

                    <h3 class="text-2xl font-bold text-green-600 mt-1">
                        {{ $successfulImports ?? 0 }}
                    </h3>

                </div>

                <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center">

                    <i
                        data-lucide="check-circle"
                        class="w-5 h-5 text-green-600"
                    ></i>

                </div>

            </div>

        </div>


        {{-- Partial --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Partial
                    </p>

                    <h3 class="text-2xl font-bold text-yellow-600 mt-1">
                        {{ $partialImports ?? 0 }}
                    </h3>

                </div>

                <div class="w-11 h-11 bg-yellow-100 rounded-xl flex items-center justify-center">

                    <i
                        data-lucide="alert-triangle"
                        class="w-5 h-5 text-yellow-600"
                    ></i>

                </div>

            </div>

        </div>


        {{-- Failed --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Failed
                    </p>

                    <h3 class="text-2xl font-bold text-red-600 mt-1">
                        {{ $failedImports ?? 0 }}
                    </h3>

                </div>

                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center">

                    <i
                        data-lucide="x-circle"
                        class="w-5 h-5 text-red-600"
                    ></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Recent Import History --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-3">

            <div>

                <h2 class="text-lg font-semibold text-gray-900">
                    Recent Import History
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Latest bulk import activities.
                </p>

            </div>

            <a
                href="{{ route('bulk-imports.create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition"
            >

                <i data-lucide="plus" class="w-4 h-4"></i>

                Import CSV

            </a>

        </div>


        @if($imports->count())

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
                                Total
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
                                Date
                            </th>

                            <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach($imports as $import)

                            <tr class="hover:bg-gray-50 transition">

                                {{-- File Name --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">

                                            <i
                                                data-lucide="file-spreadsheet"
                                                class="w-5 h-5 text-indigo-600"
                                            ></i>

                                        </div>

                                        <div>

                                            <p class="font-medium text-gray-900">
                                                {{ $import->file_name }}
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                Import #{{ $import->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Auction --}}
                                <td class="px-6 py-5">

                                    @if($import->auction)

                                        <span class="text-sm text-gray-700">
                                            {{ $import->auction->name }}
                                        </span>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            Auction deleted
                                        </span>

                                    @endif

                                </td>


                                {{-- Total --}}
                                <td class="px-6 py-5">

                                    <span class="text-sm font-medium text-gray-700">
                                        {{ $import->total_rows }}
                                    </span>

                                </td>


                                {{-- Successful --}}
                                <td class="px-6 py-5">

                                    <span class="text-sm font-medium text-green-600">
                                        {{ $import->successful_rows }}
                                    </span>

                                </td>


                                {{-- Failed --}}
                                <td class="px-6 py-5">

                                    <span class="text-sm font-medium text-red-600">
                                        {{ $import->failed_rows }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-5">

                                    @if($import->status === 'completed')

                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">

                                            <i
                                                data-lucide="check"
                                                class="w-3 h-3"
                                            ></i>

                                            Completed

                                        </span>

                                    @elseif($import->status === 'partial')

                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">

                                            <i
                                                data-lucide="alert-triangle"
                                                class="w-3 h-3"
                                            ></i>

                                            Partial

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">

                                            <i
                                                data-lucide="x"
                                                class="w-3 h-3"
                                            ></i>

                                            Failed

                                        </span>

                                    @endif

                                </td>


                                {{-- Date --}}
                                <td class="px-6 py-5">

                                    <span class="text-sm text-gray-500">

                                        {{ $import->created_at?->format('d M Y, h:i A') }}

                                    </span>

                                </td>


                                {{-- Delete --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end">

                                        <form
                                            action="{{ route('bulk-imports.destroy', $import->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this import? This will also delete its imported lots and their images.');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 transition"
                                                title="Delete Import"
                                            >

                                                <i
                                                    data-lucide="trash-2"
                                                    class="w-4 h-4"
                                                ></i>

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($imports->hasPages())

                <div class="px-6 py-5 border-t border-gray-200">

                    {{ $imports->links() }}

                </div>

            @endif


        @else

            {{-- Empty State --}}
            <div class="px-6 py-16 text-center">

                <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-gray-100 flex items-center justify-center">

                    <i
                        data-lucide="file-x"
                        class="w-8 h-8 text-gray-400"
                    ></i>

                </div>

                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    No imports found
                </h3>

                <p class="text-sm text-gray-500 mb-6">
                    You have not imported any lots yet.
                </p>

                <a
                    href="{{ route('bulk-imports.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition"
                >

                    <i data-lucide="upload" class="w-5 h-5"></i>

                    Start Your First Import

                </a>

            </div>

        @endif

    </div>

</div>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });

</script>

@endsection