<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionImage extends Model
{
    protected $fillable = [
        'auction_id',
        'image',
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function images()
{
    return $this->hasMany(AuctionImage::class);
}
}
