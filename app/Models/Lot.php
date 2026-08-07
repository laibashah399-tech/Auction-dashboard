<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lot extends Model
{
    use HasFactory;

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

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    public function images()
{
    return $this->hasMany(LotImage::class);
}
}
