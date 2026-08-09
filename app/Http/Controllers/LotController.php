<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LotController extends Controller
{
    /**
     * Display all lots.
     */

public function index()
{
    $lots = Lot::with('auction')
        ->withCount('bids')
        ->orderBy('lot_number', 'asc')
        ->paginate(10);

    return view('lots.index', compact('lots'));
}



    /**
     * Show create lot form.
     */
    public function create()
    {
        $auctions = Auction::latest()->get();

        return view('lots.create', compact('auctions'));
    }

    /**
     * Store a new lot.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'auction_id' => [
                'required',
                'exists:auctions,id',
            ],

            'lot_number' => [
                'required',
                'string',
                'max:255',
                'unique:lots,lot_number',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'starting_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'current_bid' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in([
                    'available',
                    'sold',
                    'unsold',
                ]),
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Default Current Bid
        |--------------------------------------------------------------------------
        */

        if (
            !isset($validated['current_bid']) ||
            $validated['current_bid'] === null
        ) {
            $validated['current_bid'] = $validated['starting_price'];
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('lots', 'public');
        } else {
            $validated['image'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Lot
        |--------------------------------------------------------------------------
        */

        $lot = Lot::create($validated);

        return redirect()
            ->route('lots.index')
            ->with('success', 'Lot created successfully.');
    }

    /**
     * Display a single lot.
     */
    public function show(Lot $lot)
    {
        $lot->load([
            'auction',
            'bids.bidder',
        ]);

        return view('lots.show', compact('lot'));
    }

    /**
     * Show edit form.
     */
    public function edit(Lot $lot)
    {
        $auctions = Auction::latest()->get();

        return view('lots.edit', compact(
            'lot',
            'auctions'
        ));
    }

    /**
     * Update an existing lot.
     */
    public function update(Request $request, Lot $lot)
    {
        $validated = $request->validate([
            'auction_id' => [
                'required',
                'exists:auctions,id',
            ],

            'lot_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lots', 'lot_number')
                    ->ignore($lot->id),
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'starting_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'current_bid' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in([
                    'available',
                    'sold',
                    'unsold',
                ]),
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Image Only If New Image Was Uploaded
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete old image
            if (
                !empty($lot->image) &&
                Storage::disk('public')->exists($lot->image)
            ) {
                Storage::disk('public')->delete($lot->image);
            }

            // Store new image
            $validated['image'] = $request
                ->file('image')
                ->store('lots', 'public');
        } else {

            // Very important:
            // Do not replace existing image with NULL.
            unset($validated['image']);
        }

        /*
        |--------------------------------------------------------------------------
        | Update Lot
        |--------------------------------------------------------------------------
        */

        $lot->update($validated);

        return redirect()
            ->route('lots.show', $lot)
            ->with('success', 'Lot updated successfully.');
    }

    /**
     * Delete a lot.
     */
    public function destroy(Lot $lot)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Lot Image
        |--------------------------------------------------------------------------
        */

        if (
            !empty($lot->image) &&
            Storage::disk('public')->exists($lot->image)
        ) {
            Storage::disk('public')->delete($lot->image);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Lot
        |--------------------------------------------------------------------------
        */

        $lot->delete();

        return redirect()
            ->route('lots.index')
            ->with('success', 'Lot deleted successfully.');
    }
}