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

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('user_name')->nullable();

            $table->string('action');
            $table->string('module');

            $table->text('description')->nullable();

            $table->string('ip_address')->nullable();

            $table->string('method')->nullable();

            $table->string('url')->nullable();

            $table->json('old_values')->nullable();

            $table->json('new_values')->nullable();

            $table->timestamps();

            $table->index('module');
            $table->index('action');
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};