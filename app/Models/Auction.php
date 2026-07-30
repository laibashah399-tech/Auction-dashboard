<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
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

    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }
}