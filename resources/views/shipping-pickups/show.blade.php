@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-gray-900">
                        Shipping / Pickup Details
                    </h1>

                    @php
                        $statusClasses = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'processing' => 'bg-blue-100 text-blue-800',
                            'shipped' => 'bg-indigo-100 text-indigo-800',
                            'ready_for_pickup' => 'bg-purple-100 text-purple-800',
                            'delivered' => 'bg-green-100 text-green-800',
                        ];
                    @endphp

                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $statusClasses[$shippingPickup->status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucwords(str_replace('_', ' ', $shippingPickup->status)) }}
                    </span>
                </div>

                <p class="text-sm text-gray-500 mt-1">
                    Record #{{ $shippingPickup->id }}
                </p>
            </div>

            <div class="flex gap-3">

                <a href="{{ route('shipping-pickups.index') }}"
                   class="px-4 py-2.5 bg-white border border-gray-300 rounded-lg
                          text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm">
                    ← Back
                </a>

                <a href="{{ route('shipping-pickups.edit', $shippingPickup) }}"
                   class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg
                          text-sm font-semibold hover:bg-indigo-700 shadow-sm">
                    Edit
                </a>

            </div>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Shipment Card --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Delivery Information
                        </h2>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Delivery Type
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-900">
                                {{ ucfirst($shippingPickup->type) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Tracking Number
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-900">
                                {{ $shippingPickup->tracking_number ?: '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Shipping Cost
                            </p>

                            <p class="mt-1 text-lg font-bold text-gray-900">
                                {{ number_format($shippingPickup->shipping_cost ?? 0, 2) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Created
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $shippingPickup->created_at?->format('d M Y, h:i A') }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Address
                            </p>

                            <p class="mt-1 text-sm text-gray-700 leading-6">
                                {{ $shippingPickup->address ?: 'No address provided.' }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Lot Card --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Lot Information
                        </h2>
                    </div>

                    <div class="p-6">

                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-xs uppercase tracking-wide text-gray-400">
                                    Lot Number
                                </p>

                                <p class="mt-1 text-lg font-bold text-gray-900">
                                    {{ $shippingPickup->lot?->lot_number ?? '—' }}
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs uppercase tracking-wide text-gray-400">
                                    Title
                                </p>

                                <p class="mt-1 text-sm font-semibold text-gray-900">
                                    {{ $shippingPickup->lot?->title ?? '—' }}
                                </p>
                            </div>

                        </div>

                        @if($shippingPickup->lot?->description)
                            <div class="mt-5 pt-5 border-t border-gray-100">
                                <p class="text-xs uppercase tracking-wide text-gray-400">
                                    Description
                                </p>

                                <p class="mt-2 text-sm text-gray-600 leading-6">
                                    {{ $shippingPickup->lot->description }}
                                </p>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Notes --}}
                @if($shippingPickup->notes)
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                        <div class="px-6 py-5 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">
                                Notes
                            </h2>
                        </div>

                        <div class="p-6">
                            <p class="text-sm text-gray-600 leading-7">
                                {{ $shippingPickup->notes }}
                            </p>
                        </div>

                    </div>
                @endif

            </div>

            {{-- Right Sidebar --}}
            <div class="space-y-6">

                {{-- Bidder --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Bidder
                        </h2>
                    </div>

                    <div class="p-6">

                        <p class="text-lg font-bold text-gray-900">
                            {{ $shippingPickup->bidder?->name ?? '—' }}
                        </p>

                        @if($shippingPickup->bidder?->email)
                            <p class="text-sm text-gray-500 mt-2">
                                {{ $shippingPickup->bidder->email }}
                            </p>
                        @endif

                        @if($shippingPickup->bidder?->phone)
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $shippingPickup->bidder->phone }}
                            </p>
                        @endif

                    </div>
                </div>

                {{-- Seller --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Seller
                        </h2>
                    </div>

                    <div class="p-6">

                        <p class="text-lg font-bold text-gray-900">
                            {{ $shippingPickup->seller?->name ?? '—' }}
                        </p>

                        @if($shippingPickup->seller?->company)
                            <p class="text-sm text-gray-500 mt-2">
                                {{ $shippingPickup->seller->company }}
                            </p>
                        @endif

                        @if($shippingPickup->seller?->email)
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $shippingPickup->seller->email }}
                            </p>
                        @endif

                    </div>
                </div>

                {{-- Payment --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">
                            Payment
                        </h2>
                    </div>

                    <div class="p-6">

                        @if($shippingPickup->payment)
                            <p class="text-xs uppercase tracking-wide text-gray-400">
                                Payment #{{ $shippingPickup->payment->id }}
                            </p>

                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ number_format($shippingPickup->payment->amount, 2) }}
                            </p>

                            <p class="text-sm text-gray-500 mt-2">
                                {{ ucfirst($shippingPickup->payment->status) }}
                            </p>
                        @else
                            <p class="text-sm text-gray-500">
                                No payment linked.
                            </p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

