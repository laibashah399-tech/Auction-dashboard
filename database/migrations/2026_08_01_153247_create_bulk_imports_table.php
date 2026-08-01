<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bulk_imports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auction_id')
                ->nullable()
                ->constrained('auctions')
                ->nullOnDelete();

            $table->string('file_name');

            $table->unsignedInteger('total_rows')->default(0);

            $table->unsignedInteger('successful_rows')->default(0);

            $table->unsignedInteger('failed_rows')->default(0);

            $table->enum('status', [
                'completed',
                'partial',
                'failed',
            ])->default('completed');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulk_imports');
    }
};