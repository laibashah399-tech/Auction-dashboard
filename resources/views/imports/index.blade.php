@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Bulk Imports
            </h1>

            <p class="text-gray-500 mt-1">
                Import and manage lots using CSV files.
            </p>
        </div>

        <a
            href="{{ route('bulk-imports.create') }}"
            class="bg-indigo-600 text-white px-5 py-3 rounded-lg hover:bg-indigo-700"
        >
            + New Import
        </a>

    </div>


    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">

            @foreach($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif


    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <p class="text-gray-500">Total Imports</p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $totalImports }}
            </h2>
        </div>


        <div class="bg-white p-6 rounded-xl shadow-sm">
            <p class="text-gray-500">Successful</p>
            <h2 class="text-3xl font-bold text-green-600 mt-2">
                {{ $successfulImports }}
            </h2>
        </div>


        <div class="bg-white p-6 rounded-xl shadow-sm">
            <p class="text-gray-500">Partial</p>
            <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                {{ $partialImports }}
            </h2>
        </div>


        <div class="bg-white p-6 rounded-xl shadow-sm">
            <p class="text-gray-500">Failed</p>
            <h2 class="text-3xl font-bold text-red-600 mt-2">
                {{ $failedImports }}
            </h2>
        </div>

    </div>


    <div class="bg-white rounded-xl shadow-sm overflow-hidden">

        <div class="p-6 border-b">

            <h2 class="text-xl font-bold text-gray-800">
                Import History
            </h2>

            <p class="text-gray-500 text-sm">
                View all previously imported CSV files.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4">
                            File Name
                        </th>

                        <th class="text-left px-6 py-4">
                            Auction
                        </th>

                        <th class="text-left px-6 py-4">
                            Total Rows
                        </th>

                        <th class="text-left px-6 py-4">
                            Successful
                        </th>

                        <th class="text-left px-6 py-4">
                            Failed
                        </th>

                        <th class="text-left px-6 py-4">
                            Status
                        </th>

                        <th class="text-left px-6 py-4">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($imports as $import)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium">
                                {{ $import->file_name }}
                            </td>


                            <td class="px-6 py-4">

                                {{ $import->auction->name ?? 'N/A' }}

                            </td>


                            <td class="px-6 py-4">

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

                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                        Completed
                                    </span>

                                @elseif($import->status === 'partial')

                                    <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                                        Partial
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
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
                                        class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200"
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
                                class="text-center py-12 text-gray-500"
                            >

                                No bulk imports found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="p-6">

            {{ $imports->links() }}

        </div>

    </div>

</div>

@endsection