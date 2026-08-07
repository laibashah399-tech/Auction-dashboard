<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    protected $fillable = [
        'bidder_number',
        'name',
        'email',
        'phone',
        'address',
        'status',
        'total_bids',
        'total_spent',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}