<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Lot;
use App\Models\Bidder;
use App\Models\Seller;
use App\Models\Payment;
use App\Models\ShippingPickup;
use App\Models\BulkImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $term = trim($request->get('q', ''));

        if ($term === '' || strlen($term) < 2) {
            return response()->json([
                'results' => [],
            ]);
        }

        $results = [];

        /*
        |--------------------------------------------------------------------------
        | Auctions
        |--------------------------------------------------------------------------
        */

        $auctionColumns = array_intersect(
            (new Auction)->getFillable(),
            ['name', 'description', 'status']
        );

        if (!empty($auctionColumns)) {

            $auctions = Auction::query()
                ->where(function ($query) use ($auctionColumns, $term) {

                    foreach ($auctionColumns as $column) {
                        $query->orWhere(
                            $column,
                            'LIKE',
                            '%' . $term . '%'
                        );
                    }

                })
                ->latest()
                ->limit(5)
                ->get();

            foreach ($auctions as $auction) {

                $results[] = [
                    'type' => 'Auctions',
                    'icon' => 'gavel',
                    'title' => $auction->name,
                    'subtitle' => ucfirst($auction->status ?? 'Auction'),
                    'url' => Route::has('auctions.show')
                        ? route('auctions.show', $auction)
                        : route('auctions.index'),
                ];
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Lots
        |--------------------------------------------------------------------------
        */

        if (class_exists(Lot::class)) {

            $lotColumns = array_intersect(
                (new Lot)->getFillable(),
                [
                    'lot_number',
                    'title',
                    'description',
                    'status'
                ]
            );

            if (!empty($lotColumns)) {

                $lots = Lot::query()
                    ->where(function ($query) use ($lotColumns, $term) {

                        foreach ($lotColumns as $column) {
                            $query->orWhere(
                                $column,
                                'LIKE',
                                '%' . $term . '%'
                            );
                        }

                    })
                    ->latest()
                    ->limit(5)
                    ->get();

                foreach ($lots as $lot) {

                    $results[] = [
                        'type' => 'Lots',
                        'icon' => 'package',
                        'title' => $lot->title
                            ?? ('Lot #' . ($lot->lot_number ?? $lot->id)),
                        'subtitle' => 'Lot #' . ($lot->lot_number ?? $lot->id),
                        'url' => Route::has('lots.show')
                            ? route('lots.show', $lot)
                            : route('lots.index'),
                    ];
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Bidders
        |--------------------------------------------------------------------------
        */

        if (class_exists(Bidder::class)) {

            $bidderColumns = array_intersect(
                (new Bidder)->getFillable(),
                [
                    'name',
                    'email',
                    'phone'
                ]
            );

            if (!empty($bidderColumns)) {

                $bidders = Bidder::query()
                    ->where(function ($query) use ($bidderColumns, $term) {

                        foreach ($bidderColumns as $column) {
                            $query->orWhere(
                                $column,
                                'LIKE',
                                '%' . $term . '%'
                            );
                        }

                    })
                    ->latest()
                    ->limit(5)
                    ->get();

                foreach ($bidders as $bidder) {

                    $results[] = [
                        'type' => 'Bidders',
                        'icon' => 'users',
                        'title' => $bidder->name ?? 'Bidder #' . $bidder->id,
                        'subtitle' => $bidder->email ?? 'Bidder',
                        'url' => route('bidders.index'),
                    ];
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Sellers
        |--------------------------------------------------------------------------
        */

        if (class_exists(Seller::class)) {

            $sellerColumns = array_intersect(
                (new Seller)->getFillable(),
                [
                    'name',
                    'email',
                    'phone',
                    'company'
                ]
            );

            if (!empty($sellerColumns)) {

                $sellers = Seller::query()
                    ->where(function ($query) use ($sellerColumns, $term) {

                        foreach ($sellerColumns as $column) {
                            $query->orWhere(
                                $column,
                                'LIKE',
                                '%' . $term . '%'
                            );
                        }

                    })
                    ->latest()
                    ->limit(5)
                    ->get();

                foreach ($sellers as $seller) {

                    $results[] = [
                        'type' => 'Sellers',
                        'icon' => 'store',
                        'title' => $seller->name
                            ?? 'Seller #' . $seller->id,
                        'subtitle' => $seller->email ?? 'Seller',
                        'url' => route('sellers.index'),
                    ];
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Payments
        |--------------------------------------------------------------------------
        */

        if (class_exists(Payment::class)) {

            $paymentColumns = array_intersect(
                (new Payment)->getFillable(),
                [
                    'status',
                    'payment_method',
                    'transaction_id',
                    'reference'
                ]
            );

            if (!empty($paymentColumns)) {

                $payments = Payment::query()
                    ->where(function ($query) use ($paymentColumns, $term) {

                        foreach ($paymentColumns as $column) {
                            $query->orWhere(
                                $column,
                                'LIKE',
                                '%' . $term . '%'
                            );
                        }

                    })
                    ->latest()
                    ->limit(5)
                    ->get();

                foreach ($payments as $payment) {

                    $results[] = [
                        'type' => 'Payments',
                        'icon' => 'credit-card',
                        'title' => $payment->transaction_id
                            ?? $payment->reference
                            ?? 'Payment #' . $payment->id,
                        'subtitle' => $payment->status ?? 'Payment',
                        'url' => route('payments.index'),
                    ];
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Shipping & Pickup
        |--------------------------------------------------------------------------
        */

        if (class_exists(ShippingPickup::class)) {

            $shippingColumns = array_intersect(
                (new ShippingPickup)->getFillable(),
                [
                    'name',
                    'status',
                    'tracking_number',
                    'address',
                    'phone'
                ]
            );

            if (!empty($shippingColumns)) {

                $shipping = ShippingPickup::query()
                    ->where(function ($query) use ($shippingColumns, $term) {

                        foreach ($shippingColumns as $column) {
                            $query->orWhere(
                                $column,
                                'LIKE',
                                '%' . $term . '%'
                            );
                        }

                    })
                    ->latest()
                    ->limit(5)
                    ->get();

                foreach ($shipping as $item) {

                    $results[] = [
                        'type' => 'Shipping & Pickup',
                        'icon' => 'truck',
                        'title' => $item->tracking_number
                            ?? 'Shipping #' . $item->id,
                        'subtitle' => $item->status ?? 'Shipping',
                        'url' => Route::has('shipping-pickups.index')
                            ? route('shipping-pickups.index')
                            : '#',
                    ];
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Bulk Imports
        |--------------------------------------------------------------------------
        */

        if (class_exists(BulkImport::class)) {

            $bulkColumns = array_intersect(
                (new BulkImport)->getFillable(),
                [
                    'file_name',
                    'status',
                    'message'
                ]
            );

            if (!empty($bulkColumns)) {

                $imports = BulkImport::query()
                    ->where(function ($query) use ($bulkColumns, $term) {

                        foreach ($bulkColumns as $column) {
                            $query->orWhere(
                                $column,
                                'LIKE',
                                '%' . $term . '%'
                            );
                        }

                    })
                    ->latest()
                    ->limit(5)
                    ->get();

                foreach ($imports as $import) {

                    $results[] = [
                        'type' => 'Bulk Imports',
                        'icon' => 'upload-cloud',
                        'title' => $import->file_name
                            ?? 'Import #' . $import->id,
                        'subtitle' => $import->status ?? 'Bulk Import',
                        'url' => route('bulk-imports.index'),
                    ];
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $users = User::query()
            ->where(function ($query) use ($term) {

                $query
                    ->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('email', 'LIKE', '%' . $term . '%')
                    ->orWhere('role', 'LIKE', '%' . $term . '%');

            })
            ->latest()
            ->limit(5)
            ->get();

        foreach ($users as $user) {

            $results[] = [
                'type' => 'Users & Roles',
                'icon' => 'shield-check',
                'title' => $user->name,
                'subtitle' => $user->email,
                'url' => route('users.show', $user),
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Limit Final Results
        |--------------------------------------------------------------------------
        */

        $results = array_slice($results, 0, 15);

        return response()->json([
            'results' => $results,
        ]);
    }
}