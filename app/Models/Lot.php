<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lot extends Model
{
    protected $fillable = [
        'auction_id',
        'lot_number',
        'title',
        'description',
        'starting_price',
        'current_bid',
        'status',
        'image',
    ];

    protected $casts = [
        'starting_price' => 'decimal:2',
        'current_bid' => 'decimal:2',
    ];

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }
}