<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use Illuminate\Http\Request;

class BidderController extends Controller
{
    /**
     * Display all bidders.
     */
    public function index()
    {
        $bidders = Bidder::latest()->paginate(10);

        $totalBidders = Bidder::count();

        $activeBidders = Bidder::where(
            'status',
            'active'
        )->count();

        $inactiveBidders = Bidder::where(
            'status',
            'inactive'
        )->count();

        $totalBids = Bidder::sum('total_bids');

        return view('bidders.index', compact(
            'bidders',
            'totalBidders',
            'activeBidders',
            'inactiveBidders',
            'totalBids'
        ));
    }


    /**
     * Show create bidder form.
     */
    public function create()
    {
        return view('bidders.create');
    }


    /**
     * Store new bidder.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bidder_number' => 'required|string|max:50|unique:bidders,bidder_number',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:bidders,email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['total_bids'] = 0;
        $validated['total_spent'] = 0;

        Bidder::create($validated);

        return redirect()
            ->route('bidders.index')
            ->with(
                'success',
                'Bidder created successfully.'
            );
    }


    /**
     * Show edit bidder form.
     */
    public function edit(Bidder $bidder)
    {
        return view(
            'bidders.edit',
            compact('bidder')
        );
    }


    /**
     * Update bidder.
     */
    public function update(
        Request $request,
        Bidder $bidder
    ) {
        $validated = $request->validate([
            'bidder_number' =>
                'required|string|max:50|unique:bidders,bidder_number,' .
                $bidder->id,

            'name' =>
                'required|string|max:255',

            'email' =>
                'required|email|max:255|unique:bidders,email,' .
                $bidder->id,

            'phone' =>
                'nullable|string|max:50',

            'address' =>
                'nullable|string|max:255',

            'status' =>
                'required|in:active,inactive',
        ]);

        $bidder->update($validated);

        return redirect()
            ->route('bidders.index')
            ->with(
                'success',
                'Bidder updated successfully.'
            );
    }


    /**
     * Delete bidder.
     */
    public function destroy(Bidder $bidder)
    {
        $bidder->delete();

        return redirect()
            ->route('bidders.index')
            ->with(
                'success',
                'Bidder deleted successfully.'
            );
    }
}