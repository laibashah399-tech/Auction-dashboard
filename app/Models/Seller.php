<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'address',
        'status',
        'notes',
    ];

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }
}