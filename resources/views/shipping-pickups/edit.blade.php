@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Shipping / Pickup</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Update shipping, pickup and delivery information.
                </p>
            </div>

            <a href="{{ route('shipping-pickups.show', $shippingPickup) }}"
               class="px-4 py-2.5 bg-white border border-gray-300 rounded-lg
                      text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm">
                ← Back
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="font-semibold text-red-800 mb-2">
                    Please fix the following errors:
                </div>

                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shipping-pickups.update', $shippingPickup) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                {{-- Basic Information --}}
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Order Information
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Lot --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Sold Lot
                        </label>

                        <select name="lot_id"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach($lots as $lot)
                                <option value="{{ $lot->id }}"
                                    {{ old('lot_id', $shippingPickup->lot_id) == $lot->id ? 'selected' : '' }}>
                                    {{ $lot->lot_number }} - {{ $lot->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Bidder --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Bidder
                        </label>

                        <select name="bidder_id"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach($bidders as $bidder)
                                <option value="{{ $bidder->id }}"
                                    {{ old('bidder_id', $shippingPickup->bidder_id) == $bidder->id ? 'selected' : '' }}>
                                    {{ $bidder->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Seller --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Seller
                        </label>

                        <select name="seller_id"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Seller</option>

                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}"
                                    {{ old('seller_id', $shippingPickup->seller_id) == $seller->id ? 'selected' : '' }}>
                                    {{ $seller->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Payment --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment
                        </label>

                        <select name="payment_id"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Payment</option>

                            @foreach($payments as $payment)
                                <option value="{{ $payment->id }}"
                                    {{ old('payment_id', $shippingPickup->payment_id) == $payment->id ? 'selected' : '' }}>
                                    Payment #{{ $payment->id }}
                                    — {{ number_format($payment->amount, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Delivery --}}
                <div class="px-6 py-5 border-y border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Delivery Details
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Type --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Delivery Type
                        </label>

                        <select name="type"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="shipping"
                                {{ old('type', $shippingPickup->type) == 'shipping' ? 'selected' : '' }}>
                                Shipping
                            </option>

                            <option value="pickup"
                                {{ old('type', $shippingPickup->type) == 'pickup' ? 'selected' : '' }}>
                                Pickup
                            </option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>

                        <select name="status"
                                required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'ready_for_pickup' => 'Ready for Pickup',
                                'delivered' => 'Delivered'
                            ] as $value => $label)

                                <option value="{{ $value }}"
                                    {{ old('status', $shippingPickup->status) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                    {{-- Tracking --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tracking Number
                        </label>

                        <input type="text"
                               name="tracking_number"
                               value="{{ old('tracking_number', $shippingPickup->tracking_number) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Cost --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Shipping Cost
                        </label>

                        <input type="number"
                               name="shipping_cost"
                               step="0.01"
                               min="0"
                               value="{{ old('shipping_cost', $shippingPickup->shipping_cost) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Address
                        </label>

                        <textarea name="address"
                                  rows="3"
                                  class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('address', $shippingPickup->address) }}</textarea>
                    </div>

                    {{-- Notes --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Notes
                        </label>

                        <textarea name="notes"
                                  rows="3"
                                  class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $shippingPickup->notes) }}</textarea>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="px-6 py-5 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">

                    <a href="{{ route('shipping-pickups.show', $shippingPickup) }}"
                       class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg
                              text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg
                                   text-sm font-semibold hover:bg-indigo-700">
                        Save Changes
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

