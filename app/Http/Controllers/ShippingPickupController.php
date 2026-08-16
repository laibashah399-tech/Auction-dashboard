<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use App\Models\Lot;
use App\Models\Payment;
use App\Models\Seller;
use App\Models\ShippingPickup;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;

class ShippingPickupController extends Controller
{
    /**
     * Display shipping and pickup records.
     */
    public function index(Request $request)
    {
        $query = ShippingPickup::with([
            'lot',
            'bidder',
            'seller',
            'payment',
        ]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('tracking_number', 'like', "%{$search}%")
                    ->orWhere('shipping_company', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")

                    ->orWhereHas('lot', function ($lot) use ($search) {
                        $lot->where('lot_number', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%");
                    })

                    ->orWhereHas('bidder', function ($bidder) use ($search) {
                        $bidder->where('name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('seller', function ($seller) use ($search) {
                        $seller->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Delivery method filter
        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $shipments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics
        $totalRecords = ShippingPickup::count();

        $pending = ShippingPickup::where('status', 'pending')->count();

        $processing = ShippingPickup::where('status', 'processing')->count();

        $shipped = ShippingPickup::where('status', 'shipped')->count();

        $readyForPickup = ShippingPickup::where(
            'status',
            'ready_for_pickup'
        )->count();

        $delivered = ShippingPickup::where(
            'status',
            'delivered'
        )->count();

        $totalShippingCost = ShippingPickup::sum('shipping_cost');

        return view('shipping-pickups.index', compact(
            'shipments',
            'totalRecords',
            'pending',
            'processing',
            'shipped',
            'readyForPickup',
            'delivered',
            'totalShippingCost'
        ));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $lots = Lot::orderBy('lot_number')->get();

        $bidders = Bidder::orderBy('name')->get();

        $sellers = Seller::where('status', 'active')
            ->orderBy('name')
            ->get();

        $payments = Payment::orderByDesc('id')->get();

        return view('shipping-pickups.create', compact(
            'lots',
            'bidders',
            'sellers',
            'payments'
        ));
    }


    /**
     * Store shipping / pickup record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'lot_id' => [
                'required',
                'exists:lots,id'
            ],

            'bidder_id' => [
                'required',
                'exists:bidders,id'
            ],

            'seller_id' => [
                'nullable',
                'exists:sellers,id'
            ],

            'payment_id' => [
                'nullable',
                'exists:payments,id'
            ],

            'type' => [
                'required',
                'in:shipping,pickup'
            ],

            'status' => [
                'required',
                'in:pending,processing,shipped,ready_for_pickup,delivered'
            ],

            'tracking_number' => [
                'nullable',
                'string',
                'max:255'
            ],

            'shipping_cost' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'notes' => [
                'nullable',
                'string'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Convert type -> method
        |--------------------------------------------------------------------------
        */

        $validated['method'] = $validated['type'];

        unset($validated['type']);


        /*
        |--------------------------------------------------------------------------
        | Convert address -> shipping_address
        |--------------------------------------------------------------------------
        */

        $validated['shipping_address'] = $validated['address'] ?? null;

        unset($validated['address']);


        /*
        |--------------------------------------------------------------------------
        | Create record
        |--------------------------------------------------------------------------
        */

        $shippingPickup = ShippingPickup::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Automatic Notification
        |--------------------------------------------------------------------------
        */

        $lot = Lot::find($shippingPickup->lot_id);

        $methodText = $shippingPickup->method === 'shipping'
            ? 'Shipping'
            : 'Pickup';

        $statusText = ucwords(
            str_replace('_', ' ', $shippingPickup->status)
        );

        User::all()->each(function ($user) use (
            $lot,
            $methodText,
            $statusText,
            $shippingPickup
        ) {

            $user->notify(new SystemNotification(
                'Shipping / Pickup Created',
                $methodText .
                ' record created for lot "' .
                ($lot->title ?? 'Unknown Lot') .
                '". Status: ' .
                $statusText .
                '.',
                'shipping'
            ));
        });


        return redirect()
            ->route('shipping-pickups.index')
            ->with(
                'success',
                'Shipping / Pickup record created successfully.'
            );
    }


    /**
     * Display a single shipping / pickup record.
     */
    public function show(ShippingPickup $shippingPickup)
    {
        $shippingPickup->load([
            'lot',
            'bidder',
            'seller',
            'payment',
        ]);

        return view(
            'shipping-pickups.show',
            compact('shippingPickup')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(ShippingPickup $shippingPickup)
    {
        $lots = Lot::orderBy('lot_number')->get();

        $bidders = Bidder::orderBy('name')->get();

        $sellers = Seller::where('status', 'active')
            ->orderBy('name')
            ->get();

        $payments = Payment::orderByDesc('id')->get();

        return view(
            'shipping-pickups.edit',
            compact(
                'shippingPickup',
                'lots',
                'bidders',
                'sellers',
                'payments'
            )
        );
    }


    /**
     * Update shipping / pickup record.
     */
    public function update(
        Request $request,
        ShippingPickup $shippingPickup
    ) {
        $validated = $request->validate([

            'lot_id' => [
                'required',
                'exists:lots,id'
            ],

            'bidder_id' => [
                'required',
                'exists:bidders,id'
            ],

            'seller_id' => [
                'nullable',
                'exists:sellers,id'
            ],

            'payment_id' => [
                'nullable',
                'exists:payments,id'
            ],

            'type' => [
                'required',
                'in:shipping,pickup'
            ],

            'status' => [
                'required',
                'in:pending,processing,shipped,ready_for_pickup,delivered'
            ],

            'tracking_number' => [
                'nullable',
                'string',
                'max:255'
            ],

            'shipping_cost' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'notes' => [
                'nullable',
                'string'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Convert type -> method
        |--------------------------------------------------------------------------
        */

        $validated['method'] = $validated['type'];

        unset($validated['type']);


        /*
        |--------------------------------------------------------------------------
        | Convert address -> shipping_address
        |--------------------------------------------------------------------------
        */

        $validated['shipping_address'] = $validated['address'] ?? null;

        unset($validated['address']);


        /*
        |--------------------------------------------------------------------------
        | Detect status change
        |--------------------------------------------------------------------------
        */

        $oldStatus = $shippingPickup->status;

        $shippingPickup->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Automatic Notification
        |--------------------------------------------------------------------------
        */

        $lot = Lot::find($shippingPickup->lot_id);

        $methodText = $shippingPickup->method === 'shipping'
            ? 'Shipping'
            : 'Pickup';

        $newStatus = $shippingPickup->status;

        $statusText = ucwords(
            str_replace('_', ' ', $newStatus)
        );


        // Only send notification when status actually changes
        if ($oldStatus !== $newStatus) {

            User::all()->each(function ($user) use (
                $lot,
                $methodText,
                $statusText
            ) {

                $user->notify(new SystemNotification(
                    'Shipping Status Updated',
                    $methodText .
                    ' status for lot "' .
                    ($lot->title ?? 'Unknown Lot') .
                    '" changed to ' .
                    $statusText .
                    '.',
                    'shipping'
                ));
            });
        }


        return redirect()
            ->route('shipping-pickups.index')
            ->with(
                'success',
                'Shipping / Pickup record updated successfully.'
            );
    }


    /**
     * Delete shipping / pickup record.
     */
    public function destroy(ShippingPickup $shippingPickup)
    {
        $shippingPickup->delete();


        /*
        |--------------------------------------------------------------------------
        | Automatic Notification
        |--------------------------------------------------------------------------
        */

        User::all()->each(function ($user) {

            $user->notify(new SystemNotification(
                'Shipping / Pickup Deleted',
                'A shipping or pickup record has been deleted.',
                'shipping'
            ));
        });


        return redirect()
            ->route('shipping-pickups.index')
            ->with(
                'success',
                'Shipping / Pickup record deleted successfully.'
            );
    }
}