<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BulkImport extends Model
{
    protected $fillable = [
        'file_name',
        'auction_id',
        'total_rows',
        'successful_rows',
        'failed_rows',
        'status',
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
