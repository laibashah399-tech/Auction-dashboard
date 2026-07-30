<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bidder extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}