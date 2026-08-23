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
        Schema::create('helpdesk_messages', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Tiket
            |--------------------------------------------------------------------------
            */
            $table->foreignId('ticket_id')
                ->constrained('helpdesk_tickets')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Pengirim
            |--------------------------------------------------------------------------
            |
            | NULL dapat digunakan untuk pesan sistem.
            |
            | Jika masyarakat login:
            | user_id = ID user
            |
            | Jika petugas:
            | user_id = ID user petugas
            |
            */
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Jenis pengirim
            |--------------------------------------------------------------------------
            |
            | citizen = masyarakat
            | staff   = petugas
            | system  = sistem
            |
            */
            $table->string('sender_type', 20);

            /*
            |--------------------------------------------------------------------------
            | Isi pesan
            |--------------------------------------------------------------------------
            */
            $table->text('message');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index('ticket_id');

            $table->index('user_id');

            $table->index('sender_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpdesk_messages');
    }
};