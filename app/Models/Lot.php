<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bidder;
use App\Traits\Auditable;
class Lot extends Model
{
    use Auditable;
    use HasFactory;

    protected $fillable = [
        'auction_id',
        'import_id',
        'lot_number',
        'title',
        'description',
        'starting_price',
        'current_bid',
        'status',
        'image',
    ];

    /**
     * Auction relationship.
     */
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    /**
     * Bulk import relationship.
     */
    public function bulkImport()
    {
        return $this->belongsTo(
            BulkImport::class,
            'import_id'
        );
    }

    /**
     * Bids relationship.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Multiple images relationship.
     */
    public function images()
    {
        return $this->hasMany(LotImage::class);
    }

    public function winner()
{
    return $this->belongsTo(Bidder::class, 'winning_bidder_id');
}

    public function shippingPickup()
    {
        return $this->hasOne(ShippingPickup::class);
    }
}

