<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'code' => 'PA',
                'name' => 'Pengguna Anggaran',
                'description' => 'Pengguna Anggaran.',
            ],

            [
                'code' => 'KPA',
                'name' => 'Kuasa Pengguna Anggaran',
                'description' => 'Kuasa Pengguna Anggaran.',
            ],

            [
                'code' => 'PPK',
                'name' => 'Pejabat Pembuat Komitmen',
                'description' => 'Pejabat Pembuat Komitmen.',
            ],

            [
                'code' => 'PP',
                'name' => 'Pejabat Pengadaan',
                'description' => 'Pejabat Pengadaan.',
            ],

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
            Position::updateOrCreate(
                [
                    'code' => $position['code'],
                ],
                [
                    'name' => $position['name'],
                    'description' => $position['description'],
                ]
            );
        }
    }
}