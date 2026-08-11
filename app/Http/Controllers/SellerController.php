<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SellerController extends Controller
{
    /**
     * Display a listing of sellers.
     */
    public function index(Request $request)
    {
        $query = Seller::query();

        // Search
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get sellers
        $sellers = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics
        $totalSellers = Seller::count();

        $activeSellers = Seller::where('status', 'active')
            ->count();

        $inactiveSellers = Seller::where('status', 'inactive')
            ->count();

        return view('sellers.index', compact(
            'sellers',
            'totalSellers',
            'activeSellers',
            'inactiveSellers'
        ));
    }

    /**
     * Show create seller form.
     */
    public function create()
    {
        return view('sellers.create');
    }

    /**
     * Store a new seller.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:sellers,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'company' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        Seller::create($validated);

        return redirect()
            ->route('sellers.index')
            ->with('success', 'Seller created successfully.');
    }

    /**
     * Display a specific seller.
     */
    public function show(Seller $seller)
    {
        return view('sellers.show', compact('seller'));
    }

    /**
     * Show edit seller form.
     */
    public function edit(Seller $seller)
    {
        return view('sellers.edit', compact('seller'));
    }

    /**
     * Update an existing seller.
     */
    public function update(Request $request, Seller $seller)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('sellers', 'email')
                    ->ignore($seller->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'company' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $seller->update($validated);

        return redirect()
            ->route('sellers.index')
            ->with('success', 'Seller updated successfully.');
    }

    /**
     * Delete a seller.
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();

        return redirect()
            ->route('sellers.index')
            ->with('success', 'Seller deleted successfully.');
    }
}

