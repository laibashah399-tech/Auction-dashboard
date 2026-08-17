<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {

            $table->id();

            // =========================================================
            // USER INFORMATION
            // =========================================================

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('user_name')
                ->nullable();


            // =========================================================
            // ACTION INFORMATION
            // =========================================================

            $table->string('action');

            $table->string('module');

            $table->string('auditable_type')
                ->nullable();

            $table->unsignedBigInteger('auditable_id')
                ->nullable();


            // =========================================================
            // DESCRIPTION
            // =========================================================

            $table->text('description')
                ->nullable();


            // =========================================================
            // REQUEST INFORMATION
            // =========================================================

            $table->string('ip_address')
                ->nullable();

            $table->string('method')
                ->nullable();

            $table->text('url')
                ->nullable();


            // =========================================================
            // OLD / NEW VALUES
            // =========================================================

            $table->json('old_values')
                ->nullable();

            $table->json('new_values')
                ->nullable();


            // =========================================================
            // TIMESTAMPS
            // =========================================================

            $table->timestamps();


            // =========================================================
            // INDEXES
            // =========================================================

            $table->index('module');

            $table->index('action');

            $table->index('user_id');

            $table->index([
                'auditable_type',
                'auditable_id'
            ]);

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};