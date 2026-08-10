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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            /*
             * User yang membuat konten.
             */
            $table->foreignId('author_id')
                ->constrained('users')
                ->restrictOnDelete();

            /*
             * Jenis konten:
             * news         = Berita
             * announcement = Pengumuman
             * regulation   = Regulasi
             */
            $table->string('type', 30);

            /*
             * Judul konten.
             */
            $table->string('title');

            /*
             * URL-friendly identifier.
             */
            $table->string('slug')->unique();

            /*
             * Ringkasan konten.
             */
            $table->text('excerpt')->nullable();

            /*
             * Isi lengkap konten.
             */
            $table->longText('content');

            /*
             * Path/nama file gambar utama.
             */
            $table->string('featured_image')->nullable();

            /*
             * Status konten:
             * draft
             * published
             * archived
             */
            $table->string('status', 20)
                ->default('draft');

            /*
             * Waktu konten dipublikasikan.
             */
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            /*
             * Index untuk filtering dan pencarian.
             */
            $table->index(['type', 'status']);
            $table->index('author_id');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};