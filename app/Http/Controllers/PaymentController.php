<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Bidder;
use App\Models\Lot;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display all payments.
     */
    public function index()
    {
        $payments = Payment::with(['bidder', 'lot'])
            ->latest()
            ->paginate(10);

        $totalPayments = Payment::count();

        $totalAmount = Payment::sum('amount');

        $paidAmount = Payment::where('status', 'paid')
            ->sum('amount');

        $pendingAmount = Payment::where('status', 'pending')
            ->sum('amount');

        $failedPayments = Payment::where('status', 'failed')
            ->count();

        return view('payments.index', compact(
            'payments',
            'totalPayments',
            'totalAmount',
            'paidAmount',
            'pendingAmount',
            'failedPayments'
        ));
    }


    /**
     * Show create payment form.
     */
    public function create()
    {
        $bidders = Bidder::latest()->get();

        $lots = Lot::latest()->get();

        return view('payments.create', compact(
            'bidders',
            'lots'
        ));
    }


    /**
     * Store new payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'bidder_id' => [
                'required',
                'exists:bidders,id'
            ],

            'lot_id' => [
                'required',
                'exists:lots,id'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'status' => [
                'required',
                'in:pending,paid,failed'
            ],

            'payment_method' => [
                'nullable',
                'string',
                'max:100'
            ],

        ]);


        Payment::create($validated);


        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment created successfully.'
            );
    }


    /**
     * Show edit payment form.
     */
    public function edit(Payment $payment)
    {
        $bidders = Bidder::latest()->get();

        $lots = Lot::latest()->get();

        return view('payments.edit', compact(
            'payment',
            'bidders',
            'lots'
        ));
    }


    /**
     * Update payment.
     */
    public function update(
        Request $request,
        Payment $payment
    ) {
        $validated = $request->validate([

            'bidder_id' => [
                'required',
                'exists:bidders,id'
            ],

            'lot_id' => [
                'required',
                'exists:lots,id'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'status' => [
                'required',
                'in:pending,paid,failed'
            ],

            'payment_method' => [
                'nullable',
                'string',
                'max:100'
            ],

        ]);


        $payment->update($validated);


        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment updated successfully.'
            );
    }


    /**
     * Delete payment.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();


        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment deleted successfully.'
            );
    }
}