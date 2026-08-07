<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lots', function (Blueprint $table) {

            $table->id();

            // Auction Relationship
            $table->foreignId('auction_id')
                ->constrained()
                ->cascadeOnDelete();

            // Lot Information
            $table->string('lot_number')->unique();
            $table->string('title');
            $table->text('description')->nullable();

            // Pricing
            $table->decimal('starting_price', 15, 2)->default(0);
            $table->decimal('reserve_price', 15, 2)->nullable();
            $table->decimal('current_bid', 15, 2)->default(0);
            $table->decimal('bid_increment', 15, 2)->default(10);

            // Winner
            $table->foreignId('winning_bidder_id')
                ->nullable()
                ->constrained('bidders')
                ->nullOnDelete();

            // Live Bidding
            $table->boolean('is_open')->default(false);
            $table->dateTime('bidding_start')->nullable();
            $table->dateTime('bidding_end')->nullable();

            // Lot Status
            $table->enum('status', [
                'available',
                'live',
                'sold',
                'unsold'
            ])->default('available');

            // Main Image
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};