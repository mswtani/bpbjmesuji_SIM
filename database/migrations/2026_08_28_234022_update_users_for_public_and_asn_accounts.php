<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tambah struktur baru
        |--------------------------------------------------------------------------
        */

        Schema::table('users', function (Blueprint $table) {

            $table->enum('user_type', [
                'public',
                'asn',
            ])->default('public')->after('role_id');


            $table->enum('approval_status', [
                'pending',
                'approved',
                'rejected',
            ])->default('approved')->after('is_active');


            $table->foreignId('approved_by')
                ->nullable()
                ->after('approval_status')
                ->constrained('users')
                ->nullOnDelete();


            $table->timestamp('approved_at')
                ->nullable()
                ->after('approved_by');


            $table->timestamp('rejected_at')
                ->nullable()
                ->after('approved_at');


            $table->text('rejection_reason')
                ->nullable()
                ->after('rejected_at');
        });


        /*
        |--------------------------------------------------------------------------
        | Ubah NIP dan Position menjadi nullable
        |--------------------------------------------------------------------------
        */

        Schema::table('users', function (Blueprint $table) {

            $table->string('nip', 30)
                ->nullable()
                ->change();


            $table->foreignId('position_id')
                ->nullable()
                ->change();
        });


        /*
        |--------------------------------------------------------------------------
        | Migrasi data lama
        |--------------------------------------------------------------------------
        |
        | Semua user lama dengan position NON_PENYEDIA
        | menjadi PUBLIC dan position dikosongkan.
        */

        DB::table('users')
            ->whereIn('position_id', function ($query) {
                $query->select('id')
                    ->from('positions')
                    ->whereIn('code', [
                        'NON_PENYEDIA',
                        'PENYEDIA',
                    ]);
            })
            ->update([
                'user_type' => 'public',
                'position_id' => null,
                'nip' => null,
                'approval_status' => 'approved',
            ]);


        /*
        |--------------------------------------------------------------------------
        | User ASN lama
        |--------------------------------------------------------------------------
        |
        | Position selain NON_PENYEDIA/PENYEDIA dianggap ASN.
        */

        DB::table('users')
            ->whereNotNull('position_id')
            ->update([
                'user_type' => 'asn',
                'approval_status' => 'approved',
            ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tidak aman mengembalikan NIP dan position menjadi wajib
        |--------------------------------------------------------------------------
        |
        | Karena setelah sistem PUBLIC aktif, bisa terdapat user
        | tanpa NIP dan tanpa position.
        */

        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['approved_by']);

            $table->dropColumn([
                'approved_by',
                'rejection_reason',
                'rejected_at',
                'approved_at',
                'approval_status',
                'user_type',
            ]);
        });
    }
};