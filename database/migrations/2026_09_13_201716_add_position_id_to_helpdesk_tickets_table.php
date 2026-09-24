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
        Schema::table('helpdesk_tickets', function (Blueprint $table) {
            $table->foreignId('position_id')
                ->nullable()
                ->after('category_id')
                ->constrained('positions')
                ->nullOnDelete();

            $table->index('position_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('helpdesk_tickets', function (Blueprint $table) {
            $table->dropForeign(['position_id']);
            $table->dropIndex(['position_id']);
            $table->dropColumn('position_id');
        });
    }
};