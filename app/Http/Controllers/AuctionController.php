<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::withCount('lots')
            ->latest()
            ->paginate(10);

        return view('auctions.index', compact('auctions'));
    }

    public function create()
    {
        return view('auctions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,upcoming,live,completed',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'total_sales' => 'nullable|numeric|min:0',
        ]);

        $auction = Auction::create($validated);

        // Upload Multiple Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('auctions', 'public');

                $auction->images()->create([
                    'image' => $path,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Notification: Auction Created
        |--------------------------------------------------------------------------
        */

        if (auth()->check()) {
            auth()->user()->notify(
                new SystemNotification(
                    'New Auction Created',
                    $auction->name . ' has been successfully created.',
                    'auction'
                )
            );
        }

        return redirect()
            ->route('auctions.index')
            ->with('success', 'Auction created successfully.');
    }

    public function show(Auction $auction)
    {
        $auction->load([
            'lots' => function ($query) {
                $query->withCount('bids')
                    ->with('bids')
                    ->latest();
            }
        ]);

        return view('auctions.show', compact('auction'));
    }

    public function edit(Auction $auction)
    {
        return view('auctions.edit', compact('auction'));
    }

    public function update(Request $request, Auction $auction)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,upcoming,live,completed',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'total_sales' => 'nullable|numeric|min:0',
        ]);

        $oldStatus = $auction->status;

        $auction->update($validated);

        /*
        |--------------------------------------------------------------------------
        | Notification: Auction Status Changed
        |--------------------------------------------------------------------------
        */

        if (auth()->check()) {

            if ($oldStatus !== $auction->status) {

                if ($auction->status === 'live') {

                    auth()->user()->notify(
                        new SystemNotification(
                            'Auction Started',
                            $auction->name . ' is now live and accepting bids.',
                            'auction'
                        )
                    );

                } elseif ($auction->status === 'completed') {

                    auth()->user()->notify(
                        new SystemNotification(
                            'Auction Completed',
                            $auction->name . ' has been completed.',
                            'auction'
                        )
                    );

                } else {

                    auth()->user()->notify(
                        new SystemNotification(
                            'Auction Updated',
                            $auction->name . ' status has been changed to ' . $auction->status . '.',
                            'auction'
                        )
                    );
                }

            } else {

                auth()->user()->notify(
                    new SystemNotification(
                        'Auction Updated',
                        $auction->name . ' has been successfully updated.',
                        'auction'
                    )
                );
            }
        }

        return redirect()
            ->route('auctions.show', $auction)
            ->with('success', 'Auction updated successfully.');
    }

    public function destroy(Auction $auction)
    {
        /*
        |--------------------------------------------------------------------------
        | Save auction name before deleting
        |--------------------------------------------------------------------------
        */

        $auctionName = $auction->name;

        $auction->delete();

        /*
        |--------------------------------------------------------------------------
        | Notification: Auction Deleted
        |--------------------------------------------------------------------------
        */

        if (auth()->check()) {
            auth()->user()->notify(
                new SystemNotification(
                    'Auction Deleted',
                    $auctionName . ' has been successfully deleted.',
                    'auction'
                )
            );
        }

        return redirect()
            ->route('auctions.index')
            ->with('success', 'Auction deleted successfully.');
    }
}