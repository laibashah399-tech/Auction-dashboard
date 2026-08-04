@extends('layouts.app')

@section('title', 'Add Payment')

@section('page-heading', 'Add Payment')

@section('page-description', 'Create a new payment record.')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-8">

        <a
            href="{{ route('payments.index') }}"
            class="text-sm text-indigo-600 hover:text-indigo-800"
        >
            ← Back to Payments
        </a>

        <h1 class="text-3xl font-bold text-slate-800 mt-3">
            Add Payment
        </h1>

        <p class="text-slate-500 mt-1">
            Enter the payment details below.
        </p>

    </div>


    @if($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200
                    text-red-700 px-5 py-4 rounded-xl">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white rounded-2xl border border-slate-100
                shadow-sm p-6 md:p-8">

        <form
            action="{{ route('payments.store') }}"
            method="POST"
        >

            @csrf


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Bidder --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Bidder
                    </label>

                    <select
                        name="bidder_id"
                        required
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               outline-none"
                    >

                        <option value="">
                            Select Bidder
                        </option>

                        @foreach($bidders as $bidder)

                            <option
                                value="{{ $bidder->id }}"
                                {{ old('bidder_id') == $bidder->id ? 'selected' : '' }}
                            >

                                {{ $bidder->name }}

                                @if(!empty($bidder->bidder_number))
                                    ({{ $bidder->bidder_number }})
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Lot --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Lot
                    </label>

                    <select
                        name="lot_id"
                        required
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               outline-none"
                    >

                        <option value="">
                            Select Lot
                        </option>

                        @foreach($lots as $lot)

                            <option
                                value="{{ $lot->id }}"
                                {{ old('lot_id') == $lot->id ? 'selected' : '' }}
                            >

                                {{ $lot->lot_number }} -
                                {{ $lot->title }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Amount --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Amount (£)
                    </label>

                    <input
                        type="number"
                        name="amount"
                        step="0.01"
                        min="0"
                        value="{{ old('amount') }}"
                        required
                        placeholder="Enter payment amount"
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               outline-none"
                    >

                </div>


                {{-- Payment Method --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Payment Method
                    </label>

                    <select
                        name="payment_method"
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               outline-none"
                    >

                        <option value="">
                            Select Method
                        </option>

                        <option value="Cash">
                            Cash
                        </option>

                        <option value="Bank Transfer">
                            Bank Transfer
                        </option>

                        <option value="Credit Card">
                            Credit Card
                        </option>

                        <option value="Debit Card">
                            Debit Card
                        </option>

                        <option value="Online">
                            Online Payment
                        </option>

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Payment Status
                    </label>

                    <select
                        name="status"
                        required
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               outline-none"
                    >

                        <option value="pending">
                            Pending
                        </option>

                        <option value="paid">
                            Paid
                        </option>

                        <option value="failed">
                            Failed
                        </option>

                    </select>

                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex justify-end gap-3 mt-8 pt-6
                        border-t border-slate-100">

                <a
                    href="{{ route('payments.index') }}"
                    class="px-6 py-3 bg-slate-100 text-slate-700
                           rounded-xl hover:bg-slate-200"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white
                           rounded-xl font-semibold
                           hover:bg-indigo-700"
                >
                    Save Payment
                </button>

            </div>

        </form>

    </div>

</div>

@endsection