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
        Schema::create('helpdesk_attachments', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Tiket
            |--------------------------------------------------------------------------
            |
            | Disimpan langsung agar kita dapat melakukan pencarian
            | lampiran berdasarkan tiket tanpa harus selalu melalui message.
            |
            */
            $table->foreignId('ticket_id')
                ->constrained('helpdesk_tickets')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Pesan
            |--------------------------------------------------------------------------
            */
            $table->foreignId('message_id')
                ->constrained('helpdesk_messages')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Identitas file
            |--------------------------------------------------------------------------
            */
            $table->string('original_name', 255);

            $table->string('file_path', 500);

            $table->string('mime_type', 100)
                ->nullable();

            $table->unsignedBigInteger('file_size')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Pengunggah
            |--------------------------------------------------------------------------
            |
            | NULL = guest atau sistem
            | ID   = pengguna login / petugas
            |
            */
            $table->foreignId('uploaded_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index('ticket_id');

            $table->index('message_id');

            $table->index('uploaded_by_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helpdesk_attachments');
    }
};