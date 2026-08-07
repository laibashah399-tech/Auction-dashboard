<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bidders', function (Blueprint $table) {

            if (!Schema::hasColumn('bidders', 'status')) {
                $table->string('status')
                    ->default('active');
            }

            if (!Schema::hasColumn('bidders', 'total_bid_amount')) {
                $table->decimal('total_bid_amount', 15, 2)
                    ->default(0);
            }

        });
    }

    public function down(): void
    {
        Schema::table('bidders', function (Blueprint $table) {

            if (Schema::hasColumn('bidders', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('bidders', 'total_bid_amount')) {
                $table->dropColumn('total_bid_amount');
            }

        });
    }
};