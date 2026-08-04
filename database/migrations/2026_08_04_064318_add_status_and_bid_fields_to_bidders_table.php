<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bidders', function (Blueprint $table) {
            $table->string('status')->default('active');
            $table->decimal('total_bids', 10, 2)->default(0);
            $table->decimal('total_spent', 12, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('bidders', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'total_bids',
                'total_spent',
            ]);
        });
    }
};