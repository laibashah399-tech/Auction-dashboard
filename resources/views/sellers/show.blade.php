@extends('layouts.app')

@section('title', 'Seller Details')
@section('page-heading', 'Seller Details')
@section('page-description', 'View seller information.')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">
                {{ $seller->name }}
            </h1>

            <p class="text-sm text-slate-500">
                Seller #{{ $seller->id }}
            </p>
        </div>

        <a
            href="{{ route('sellers.edit', $seller) }}"
            class="inline-flex items-center gap-2 px-4 py-2.5
                   bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">

            <i data-lucide="edit" class="w-4 h-4"></i>

            Edit Seller

        </a>

    </div>


    <div class="bg-white rounded-2xl border border-slate-200">

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <p class="text-sm text-slate-500">
                    Seller Name
                </p>

                <p class="font-semibold mt-1">
                    {{ $seller->name }}
                </p>

            </div>


            <div>

                <p class="text-sm text-slate-500">
                    Email
                </p>

                <p class="font-semibold mt-1">
                    {{ $seller->email ?: 'Not provided' }}
                </p>

            </div>


            <div>

                <p class="text-sm text-slate-500">
                    Phone
                </p>

                <p class="font-semibold mt-1">
                    {{ $seller->phone ?: 'Not provided' }}
                </p>

            </div>


            <div>

                <p class="text-sm text-slate-500">
                    Company
                </p>

                <p class="font-semibold mt-1">
                    {{ $seller->company ?: 'Individual Seller' }}
                </p>

            </div>


            <div>

                <p class="text-sm text-slate-500">
                    Status
                </p>

                <p class="mt-1">

                    @if($seller->status === 'active')

                        <span class="px-3 py-1 rounded-full bg-green-50
                                     text-green-700 text-xs font-semibold">
                            Active
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-50
                                     text-red-700 text-xs font-semibold">
                            Inactive
                        </span>

                    @endif

                </p>

            </div>


            <div class="md:col-span-2">

                <p class="text-sm text-slate-500">
                    Address
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $seller->address ?: 'No address provided.' }}
                </p>

            </div>


            <div class="md:col-span-2">

                <p class="text-sm text-slate-500">
                    Notes
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $seller->notes ?: 'No notes available.' }}
                </p>

            </div>

        </div>

    </div>

</div>

@endsection