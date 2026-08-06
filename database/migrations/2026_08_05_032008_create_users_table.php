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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('position_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nip', 30)->unique();
            $table->string('name', 150);
            $table->string('email', 150)->unique();
            $table->string('phone', 20);
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->boolean('must_change_password')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
