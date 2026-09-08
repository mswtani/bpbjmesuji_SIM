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
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            $table->foreignId('post_id')
                ->constrained('posts')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Banner
            |--------------------------------------------------------------------------
            */

            $table->string('banner');

            /*
            |--------------------------------------------------------------------------
            | Caption
            |--------------------------------------------------------------------------
            |
            | auto   = menggunakan title + excerpt dari Post
            | custom = menggunakan custom_title + custom_description
            | none   = tidak menampilkan caption
            |
            */

            $table->enum('caption_type', [
                'auto',
                'custom',
                'none',
            ])->default('auto');

            $table->string('custom_title')
                ->nullable();

            $table->text('custom_description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Button
            |--------------------------------------------------------------------------
            */

            $table->boolean('show_button')
                ->default(true);

            $table->string('button_text')
                ->default('Baca Selengkapnya');

            /*
            |--------------------------------------------------------------------------
            | Display
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')
                ->default(1);

            $table->boolean('is_active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Schedule
            |--------------------------------------------------------------------------
            */

            $table->timestamp('starts_at')
                ->nullable();

            $table->timestamp('ends_at')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Constraints & Index
            |--------------------------------------------------------------------------
            */

            $table->unique('post_id');

            $table->index([
                'is_active',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};