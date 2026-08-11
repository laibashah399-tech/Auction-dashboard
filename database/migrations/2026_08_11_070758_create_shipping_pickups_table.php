<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create shipping and pickup records table.
     */
    public function up(): void
    {
        Schema::create('shipping_pickups', function (Blueprint $table) {

            $table->id();

            // Related Lot
            $table->foreignId('lot_id')
                ->constrained('lots')
                ->cascadeOnDelete();

            // Winning Bidder / Buyer
            $table->foreignId('bidder_id')
                ->constrained('bidders')
                ->cascadeOnDelete();

            // Seller
            $table->foreignId('seller_id')
                ->nullable()
                ->constrained('sellers')
                ->nullOnDelete();

            // Related Payment
            $table->foreignId('payment_id')
                ->nullable()
                ->constrained('payments')
                ->nullOnDelete();

            // Fulfillment Method
            $table->enum('method', [
                'shipping',
                'pickup'
            ])->default('shipping');

            // Shipping Details
            $table->string('shipping_company')->nullable();
            $table->string('tracking_number')->nullable();

            // Delivery Address
            $table->text('shipping_address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            // Shipping Cost
            $table->decimal('shipping_cost', 15, 2)->default(0);

            // Fulfillment Status
            $table->enum('status', [
                'pending',
                'processing',
                'shipped',
                'ready_for_pickup',
                'picked_up',
                'delivered',
                'cancelled'
            ])->default('pending');

            // Important Dates
            $table->dateTime('pickup_date')->nullable();
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('delivered_at')->nullable();

            // Additional Notes
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Drop shipping and pickup table.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_pickups');
    }
};

