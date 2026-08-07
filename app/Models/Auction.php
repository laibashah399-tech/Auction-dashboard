<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'start_at',
        'end_at',
        'total_sales',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'total_sales' => 'decimal:2',
    ];

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(AuctionImage::class);
    }
}