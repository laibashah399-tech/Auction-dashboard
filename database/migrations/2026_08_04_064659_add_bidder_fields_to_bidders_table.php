<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bidders', function (Blueprint $table) {
            $table->string('bidder_number')->unique()->after('id');
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('address');
            $table->unsignedInteger('total_bids')->default(0)->after('status');
            $table->decimal('total_spent', 12, 2)->default(0)->after('total_bids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bidders', function (Blueprint $table) {
    $table->dropColumn([
        'bidder_number',
        'phone',
        'address',
        'status',
        'total_bids',
        'total_spent',
    ]);
});
    }
};
