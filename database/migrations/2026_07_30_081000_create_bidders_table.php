<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create bidders table.
     */
    public function up(): void
    {
        Schema::create('bidders', function (Blueprint $table) {
            $table->id();

            // Basic bidder information
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();

            // Address / profile information
            $table->text('address')->nullable();

            // Bidder status
            $table->string('status')->default('active');

            // Total amount of all bids placed by bidder
            $table->decimal('total_bid_amount', 15, 2)->default(0);

            // Additional notes
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Drop bidders table.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidders');
    }
};

