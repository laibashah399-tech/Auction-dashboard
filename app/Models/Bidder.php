<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
        'total_bid_amount',
        'notes',
    ];

    protected $casts = [
        'total_bid_amount' => 'decimal:2',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}