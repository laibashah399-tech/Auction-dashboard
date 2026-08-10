<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_id',
        'image',
    ];

    /**
     * Lot relationship.
     */
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
}

