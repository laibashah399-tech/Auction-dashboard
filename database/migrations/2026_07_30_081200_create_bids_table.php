<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bids', function (Blueprint $table) {

            $table->id();

            // Lot receiving the bid
            $table->foreignId('lot_id')
                ->constrained('lots')
                ->cascadeOnDelete();

            // Bidder placing the bid
            $table->foreignId('bidder_id')
                ->constrained('bidders')
                ->cascadeOnDelete();

            // Bid amount
            $table->decimal('amount', 15, 2);

            $table->timestamps();

            // Faster bid history and highest-bid queries
            $table->index(['lot_id', 'amount']);
            $table->index(['bidder_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};