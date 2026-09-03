<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus position lama yang sudah tidak digunakan
        |--------------------------------------------------------------------------
        |
        | PENYEDIA dan NON_PENYEDIA sudah digantikan oleh:
        |
        | user_type = public
        |
        | Dari hasil pengecekan sebelumnya, kedua position tersebut
        | tidak memiliki user.
        |
        */

        DB::table('positions')
            ->whereIn('code', [
                'PENYEDIA',
                'NON_PENYEDIA',
            ])
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | Tambahkan Position ASN Baru
        |--------------------------------------------------------------------------
        */

        $positions = [
            [
                'code' => 'POKJA',
                'name' => 'Kelompok Kerja Pemilihan',
                'description' => 'Kelompok Kerja Pemilihan.',
            ],

            [
                'code' => 'AUDITOR',
                'name' => 'Auditor',
                'description' => 'Auditor internal atau pihak pengawasan.',
            ],

            [
                'code' => 'KEPALA_BPBJ',
                'name' => 'Kepala BPBJ',
                'description' => 'Kepala Bagian Pengadaan Barang dan Jasa.',
            ],

            [
                'code' => 'SEKDA',
                'name' => 'Sekretaris Daerah',
                'description' => 'Sekretaris Daerah.',
            ],

            [
                'code' => 'WAKIL_BUPATI',
                'name' => 'Wakil Bupati',
                'description' => 'Wakil Bupati.',
            ],

            [
                'code' => 'BUPATI',
                'name' => 'Bupati',
                'description' => 'Bupati.',
            ],
        ];


        foreach ($positions as $position) {
            DB::table('positions')->updateOrInsert(
                [
                    'code' => $position['code'],
                ],
                [
                    'name' => $position['name'],
                    'description' => $position['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus Position baru
        |--------------------------------------------------------------------------
        */

        DB::table('positions')
            ->whereIn('code', [
                'POKJA',
                'AUDITOR',
                'KEPALA_BPBJ',
                'SEKDA',
                'WAKIL_BUPATI',
                'BUPATI',
            ])
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | Kembalikan Position lama
        |--------------------------------------------------------------------------
        */

        $positions = [
            [
                'code' => 'PENYEDIA',
                'name' => 'Penyedia barang jasa',
                'description' => 'Pelaku usaha penyedia barang dan jasa.',
            ],

            [
                'code' => 'NON_PENYEDIA',
                'name' => 'Non penydia',
                'description' => 'Masyarakat, Aparat Pengawas, Akademisi, atau pihak lain di luar penyedia.',
            ],
        ];


        foreach ($positions as $position) {
            DB::table('positions')->updateOrInsert(
                [
                    'code' => $position['code'],
                ],
                [
                    'name' => $position['name'],
                    'description' => $position['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
};