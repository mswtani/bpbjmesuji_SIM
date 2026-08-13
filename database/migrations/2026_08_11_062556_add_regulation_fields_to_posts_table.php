<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->foreignId('regulation_type_id')
                ->nullable()
                ->after('type')
                ->constrained('regulation_types')
                ->nullOnDelete();

            $table->string('regulation_number')
                ->nullable()
                ->after('regulation_type_id');

            $table->unsignedSmallInteger('regulation_year')
                ->nullable()
                ->after('regulation_number');

            $table->date('regulation_date')
                ->nullable()
                ->after('regulation_year');

            $table->string('document_path')
                ->nullable()
                ->after('featured_image');

            $table->string('document_original_name')
                ->nullable()
                ->after('document_path');

            $table->unsignedBigInteger('document_size')
                ->nullable()
                ->after('document_original_name');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->dropForeign([
                'regulation_type_id',
            ]);

            $table->dropColumn([
                'regulation_type_id',
                'regulation_number',
                'regulation_year',
                'regulation_date',
                'document_path',
                'document_original_name',
                'document_size',
            ]);
        });
    }
};