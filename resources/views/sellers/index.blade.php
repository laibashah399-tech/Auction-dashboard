@extends('layouts.app')

@section('title', 'Sellers')
@section('page-heading', 'Sellers')
@section('page-description', 'Manage auction sellers and their information.')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Sellers
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Manage all sellers registered in AuctionPro.
            </p>
        </div>

        <a href="{{ route('sellers.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-3
                  bg-indigo-600 text-white rounded-xl
                  hover:bg-indigo-700 transition">

            <i data-lucide="plus" class="w-5 h-5"></i>

            Add Seller

        </a>

    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-indigo-100
                            text-indigo-600 flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6"></i>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Total Sellers
                    </p>

                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ $totalSellers }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-green-100
                            text-green-600 flex items-center justify-center">

                    <i data-lucide="user-check" class="w-6 h-6"></i>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Active Sellers
                    </p>

                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ $activeSellers }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="bg-white rounded-2xl border border-slate-200 p-5">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-red-100
                            text-red-600 flex items-center justify-center">

                    <i data-lucide="user-x" class="w-6 h-6"></i>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Inactive Sellers
                    </p>

                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ $inactiveSellers }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    {{-- Search and Filter --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-5">

        <form method="GET"
              action="{{ route('sellers.index') }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-2">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Search Seller
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Name, email, phone or company..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none">

            </div>


            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    <option value="">
                        All Status
                    </option>

                    <option value="active"
                        {{ request('status') === 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ request('status') === 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>


            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="flex-1 px-4 py-3 bg-slate-900 text-white
                           rounded-xl hover:bg-slate-800 transition">

                    Search

                </button>

                <a
                    href="{{ route('sellers.index') }}"
                    class="px-4 py-3 border border-slate-200
                           rounded-xl hover:bg-slate-50">

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- Sellers Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold
                                   text-slate-500 uppercase">
                            Seller
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold
                                   text-slate-500 uppercase">
                            Contact
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold
                                   text-slate-500 uppercase">
                            Company
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold
                                   text-slate-500 uppercase">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold
                                   text-slate-500 uppercase">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($sellers as $seller)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Seller --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-11 h-11 rounded-full bg-indigo-100
                                                text-indigo-600 flex items-center
                                                justify-center font-bold">

                                        {{ strtoupper(substr($seller->name, 0, 2)) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-900">
                                            {{ $seller->name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Seller #{{ $seller->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Contact --}}
                            <td class="px-6 py-4">

                                <p class="text-sm text-slate-700">
                                    {{ $seller->email ?: 'No email' }}
                                </p>

                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $seller->phone ?: 'No phone' }}
                                </p>

                            </td>


                            {{-- Company --}}
                            <td class="px-6 py-4 text-sm text-slate-700">

                                {{ $seller->company ?: 'Individual Seller' }}

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($seller->status === 'active')

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1 rounded-full
                                                 bg-green-50 text-green-700
                                                 text-xs font-semibold">

                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1 rounded-full
                                                 bg-red-50 text-red-700
                                                 text-xs font-semibold">

                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    <a
                                        href="{{ route('sellers.show', $seller) }}"
                                        class="p-2 rounded-lg text-slate-500
                                               hover:bg-slate-100 hover:text-indigo-600"
                                        title="View">

                                        <i data-lucide="eye" class="w-5 h-5"></i>

                                    </a>


                                    <a
                                        href="{{ route('sellers.edit', $seller) }}"
                                        class="p-2 rounded-lg text-slate-500
                                               hover:bg-slate-100 hover:text-indigo-600"
                                        title="Edit">

                                        <i data-lucide="edit" class="w-5 h-5"></i>

                                    </a>


                                    <form
                                        action="{{ route('sellers.destroy', $seller) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this seller?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="p-2 rounded-lg text-slate-500
                                                   hover:bg-red-50 hover:text-red-600"
                                            title="Delete">

                                            <i data-lucide="trash-2" class="w-5 h-5"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="px-6 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-14 h-14 bg-slate-100 rounded-full
                                                flex items-center justify-center">

                                        <i data-lucide="users"
                                           class="w-7 h-7 text-slate-400"></i>

                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-900">
                                        No sellers found
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Add your first seller to get started.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($sellers->hasPages())

            <div class="px-6 py-4 border-t border-slate-100">

                {{ $sellers->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
