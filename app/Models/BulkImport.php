<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class BulkImport extends Model
{
    use Auditable;
    protected $fillable = [

        'file_name',

        'auction_id',

        'total_rows',

        'successful_rows',

        'failed_rows',

        'status',
    ];

    /**
     * Auction relationship.
     */
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    /**
     * Lots created by this import.
     */
    public function lots()
    {
        return $this->hasMany(
            Lot::class,
            'import_id'
        );
    }
}