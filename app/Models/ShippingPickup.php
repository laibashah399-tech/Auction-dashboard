<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingPickup extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_id',
        'bidder_id',
        'seller_id',
        'payment_id',
        'method',
        'shipping_company',
        'tracking_number',
        'shipping_address',
        'city',
        'postal_code',
        'country',
        'shipping_cost',
        'status',
        'pickup_date',
        'shipped_at',
        'delivered_at',
        'notes',
    ];

    protected $casts = [
        'shipping_cost' => 'decimal:2',
        'pickup_date' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function bidder()
    {
        return $this->belongsTo(Bidder::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

