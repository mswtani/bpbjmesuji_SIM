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
        Schema::create('helpdesk_tickets', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Pemilik tiket
            |--------------------------------------------------------------------------
            |
            | NULL = masyarakat tidak login
            | ID   = masyarakat yang login
            |
            */
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Kategori
            |--------------------------------------------------------------------------
            */
            $table->foreignId('category_id')
                ->constrained('helpdesk_categories')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Identitas tiket
            |--------------------------------------------------------------------------
            */
            $table->string('ticket_number', 30)
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Token akses untuk guest
            |--------------------------------------------------------------------------
            |
            | Token asli TIDAK disimpan.
            | Yang disimpan hanya hasil hash.
            |
            */
            $table->string('access_token_hash')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Identitas pemohon
            |--------------------------------------------------------------------------
            |
            | Tetap disimpan walaupun user login.
            | Ini menjadi snapshot identitas ketika tiket dibuat.
            |
            */
            $table->string('requester_name', 150);

            $table->string('requester_email', 255);

            $table->string('requester_phone', 30)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Isi tiket
            |--------------------------------------------------------------------------
            */
            $table->string('subject', 255);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            |
            | baru
            | diproses
            | menunggu_pemohon
            | selesai
            | ditutup
            |
            */
            $table->string('status', 30)
                ->default('baru');

            /*
            |--------------------------------------------------------------------------
            | Prioritas
            |--------------------------------------------------------------------------
            |
            | normal
            | tinggi
            | mendesak
            |
            */
            $table->string('priority', 20)
                ->default('normal');

            /*
            |--------------------------------------------------------------------------
            | Waktu aktivitas terakhir
            |--------------------------------------------------------------------------
            */
            $table->timestamp('last_message_at')
                ->nullable();

            $table->timestamp('closed_at')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index('user_id');

            $table->index('category_id');

            $table->index('status');

            $table->index('priority');

            $table->index('last_message_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpdesk_tickets');
    }
};