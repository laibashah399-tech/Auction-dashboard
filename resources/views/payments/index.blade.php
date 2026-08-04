@extends('layouts.app')

@section('title', 'Payments')

@section('page-heading', 'Payments')

@section('page-description', 'Manage and monitor all auction payments.')

@section('content')

<div class="space-y-8">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Payments
            </h1>

            <p class="text-slate-500 mt-1">
                Manage bidder payments and payment records.
            </p>
        </div>

        <a
            href="{{ route('payments.create') }}"
            class="inline-flex items-center justify-center gap-2
                   bg-indigo-600 text-white px-5 py-3
                   rounded-xl font-semibold
                   hover:bg-indigo-700 transition"
        >
            <span class="text-xl">+</span>
            Add Payment
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="bg-green-50 border border-green-200
                    text-green-700 px-5 py-4 rounded-xl">

            {{ session('success') }}

        </div>

    @endif


    {{-- STATISTICS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Total Payments --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">

            <p class="text-sm text-slate-500">
                Total Payments
            </p>

            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                {{ $totalPayments }}
            </h2>

        </div>


        {{-- Total Amount --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">

            <p class="text-sm text-slate-500">
                Total Amount
            </p>

            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                £{{ number_format($totalAmount, 2) }}
            </h2>

        </div>


        {{-- Paid --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">

            <p class="text-sm text-slate-500">
                Paid Amount
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                £{{ number_format($paidAmount, 2) }}
            </h2>

        </div>


        {{-- Pending --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">

            <p class="text-sm text-slate-500">
                Pending Amount
            </p>

            <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                £{{ number_format($pendingAmount, 2) }}
            </h2>

        </div>

    </div>


    {{-- PAYMENT TABLE --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h2 class="text-xl font-bold text-slate-800">
                Payment Records
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                View, edit, or delete payment records.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Bidder
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Lot
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Amount
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Method
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Status
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Date
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-semibold">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($payments as $payment)

                        <tr class="border-t border-slate-100 hover:bg-slate-50">

                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $payment->bidder->name ?? 'N/A' }}
                                </div>

                                <div class="text-xs text-slate-500">
                                    {{ $payment->bidder->bidder_number ?? '' }}
                                </div>

                            </td>


                            <td class="px-6 py-4">

                                <div class="font-medium text-slate-700">
                                    {{ $payment->lot->title ?? 'N/A' }}
                                </div>

                                <div class="text-xs text-slate-500">
                                    {{ $payment->lot->lot_number ?? '' }}
                                </div>

                            </td>


                            <td class="px-6 py-4 font-semibold">

                                £{{ number_format($payment->amount, 2) }}

                            </td>


                            <td class="px-6 py-4 text-slate-600">

                                {{ $payment->payment_method ?: 'N/A' }}

                            </td>


                            <td class="px-6 py-4">

                                @if($payment->status === 'paid')

                                    <span class="px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-green-100 text-green-700">
                                        Paid
                                    </span>

                                @elseif($payment->status === 'pending')

                                    <span class="px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-red-100 text-red-700">
                                        Failed
                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4 text-sm text-slate-500">

                                {{ $payment->created_at->format('d M Y') }}

                            </td>


                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <a
                                        href="{{ route('payments.edit', $payment) }}"
                                        class="px-3 py-2 bg-indigo-50
                                               text-indigo-600 rounded-lg
                                               hover:bg-indigo-100"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('payments.destroy', $payment) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this payment?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-2 bg-red-50
                                                   text-red-600 rounded-lg
                                                   hover:bg-red-100"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-16 text-slate-500"
                            >

                                <div class="text-4xl mb-3">
                                    💳
                                </div>

                                <p class="font-semibold">
                                    No payments found.
                                </p>

                                <p class="text-sm mt-1">
                                    Add your first payment record.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="p-6 border-t border-slate-100">

            {{ $payments->links() }}

        </div>

    </div>

</div>

@endsection