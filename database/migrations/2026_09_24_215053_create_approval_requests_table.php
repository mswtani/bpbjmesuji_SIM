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
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Objek yang diajukan
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | User
            | Post
            | HelpdeskMessage
            |
            */
            $table->string('requestable_type');
            $table->unsignedBigInteger('requestable_id');

            /*
            |--------------------------------------------------------------------------
            | Jenis pengajuan
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | user_registration
            | content_publish
            | helpdesk_reply
            | help_center_publish
            |
            */
            $table->string('type');

            /*
            |--------------------------------------------------------------------------
            | Pemohon
            |--------------------------------------------------------------------------
            */
            $table->foreignId('submitted_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Pemeriksa / approver
            |--------------------------------------------------------------------------
            */
            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Status approval
            |--------------------------------------------------------------------------
            */
            $table->string('status')
                ->default('pending');

            /*
            |--------------------------------------------------------------------------
            | Informasi pengajuan
            |--------------------------------------------------------------------------
            */
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('review_note')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Waktu workflow
            |--------------------------------------------------------------------------
            */
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index(
                ['requestable_type', 'requestable_id'],
                'approval_requests_requestable_index'
            );

            $table->index(
                ['type', 'status'],
                'approval_requests_type_status_index'
            );

            $table->index(
                ['submitted_by', 'status'],
                'approval_requests_submitted_status_index'
            );

            $table->index(
                ['reviewed_by', 'status'],
                'approval_requests_reviewed_status_index'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_requests');
    }
};