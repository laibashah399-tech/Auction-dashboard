<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {

            $table->string('user_name')
                ->nullable();

            $table->string('method')
                ->nullable();

            $table->text('url')
                ->nullable();

            $table->string('auditable_type')
                ->nullable();

            $table->unsignedBigInteger('auditable_id')
                ->nullable();

            $table->json('old_values')
                ->nullable();

            $table->json('new_values')
                ->nullable();

            $table->index([
                'auditable_type',
                'auditable_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {

            $table->dropIndex([
                'audit_logs_auditable_type_auditable_id_index'
            ]);

            $table->dropColumn([
                'user_name',
                'method',
                'url',
                'auditable_type',
                'auditable_id',
                'old_values',
                'new_values',
            ]);
        });
    }
};