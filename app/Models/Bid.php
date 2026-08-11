<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'lot_id',
        'bidder_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function bidder()
    {
        return $this->belongsTo(Bidder::class);
    }
}