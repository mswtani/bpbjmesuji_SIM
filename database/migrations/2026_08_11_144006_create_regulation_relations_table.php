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
        Schema::create('regulation_relations', function (Blueprint $table) {
            $table->id();

            /*
             * Regulasi utama.
             */
            $table->foreignId('post_id')
                ->constrained('posts')
                ->cascadeOnDelete();

            /*
             * Regulasi yang berhubungan.
             */
            $table->foreignId('related_post_id')
                ->constrained('posts')
                ->cascadeOnDelete();

            /*
             * Jenis hubungan:
             *
             * amends  = mengubah
             * repeals = mencabut
             */
            $table->string('relation_type', 30);

            $table->timestamps();

            /*
             * Nama index dibuat pendek karena MySQL
             * memiliki batas panjang identifier.
             */
            $table->unique(
                [
                    'post_id',
                    'related_post_id',
                    'relation_type',
                ],
                'reg_rel_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulation_relations');
    }
};