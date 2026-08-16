<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Bidder;
use App\Models\Lot;
use App\Models\User;
use App\Notifications\SystemNotification;
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


        // Create payment
        $payment = Payment::create($validated);


        // ==========================================
        // AUTOMATIC ADMIN NOTIFICATION
        // ==========================================

        $admins = User::where('role', 'Admin')->get();

        // Get bidder and lot information
        $bidder = Bidder::find($payment->bidder_id);
        $lot = Lot::find($payment->lot_id);

        // Notification title/message according to status
        if ($payment->status === 'paid') {

            $title = 'Payment Received';

            $message = 'A payment of Rs. ' .
                number_format($payment->amount, 2) .
                ' has been received successfully.';

            $type = 'payment';

        } elseif ($payment->status === 'pending') {

            $title = 'Payment Pending';

            $message = 'A payment of Rs. ' .
                number_format($payment->amount, 2) .
                ' is currently pending.';

            $type = 'warning';

        } else {

            $title = 'Payment Failed';

            $message = 'A payment of Rs. ' .
                number_format($payment->amount, 2) .
                ' has failed.';

            $type = 'error';
        }


        // Add bidder information if available
        if ($bidder) {

            $message .= ' Bidder: ' .
                $bidder->name . '.';
        }


        // Add lot information if available
        if ($lot) {

            $message .= ' Lot #' .
                $lot->id . '.';
        }


        // Send notification to all Admin users
        foreach ($admins as $admin) {

            $admin->notify(
                new SystemNotification(
                    $title,
                    $message,
                    $type
                )
            );
        }


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


        // Remember old status
        $oldStatus = $payment->status;


        // Update payment
        $payment->update($validated);


        // ==========================================
        // NOTIFICATION FOR PAYMENT UPDATE
        // ==========================================

        $admins = User::where('role', 'Admin')->get();

        // Only notify if status changed
        if ($oldStatus !== $payment->status) {

            if ($payment->status === 'paid') {

                $title = 'Payment Completed';

                $message = 'Payment of Rs. ' .
                    number_format($payment->amount, 2) .
                    ' has been marked as paid.';

                $type = 'payment';

            } elseif ($payment->status === 'pending') {

                $title = 'Payment Pending';

                $message = 'Payment of Rs. ' .
                    number_format($payment->amount, 2) .
                    ' has been marked as pending.';

                $type = 'warning';

            } else {

                $title = 'Payment Failed';

                $message = 'Payment of Rs. ' .
                    number_format($payment->amount, 2) .
                    ' has been marked as failed.';

                $type = 'error';
            }


            foreach ($admins as $admin) {

                $admin->notify(
                    new SystemNotification(
                        $title,
                        $message,
                        $type
                    )
                );
            }
        }


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