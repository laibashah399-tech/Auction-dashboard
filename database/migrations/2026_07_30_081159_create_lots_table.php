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

            $table->foreignId('auction_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('lot_number')->unique();
            $table->string('title');
            $table->text('description')->nullable();

            $table->decimal('starting_price', 15, 2)->default(0);
            $table->decimal('current_bid', 15, 2)->default(0);

            $table->enum('status', [
                'available',
                'sold',
                'unsold'
            ])->default('available');

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};