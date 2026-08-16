<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditable;

class Payment extends Model
{
    use Auditable;
    protected $fillable = [
        'bidder_id',
        'lot_id',
        'amount',
        'status',
        'payment_method',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function bidder(): BelongsTo
    {
        return $this->belongsTo(Bidder::class);
    }

    public function lot(): BelongsTo
    {
        return $this->belongsTo(Lot::class);
    }
}