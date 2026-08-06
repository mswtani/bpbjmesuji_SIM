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
        $positions= [
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
                'description' => 'Pejabaat pengadaan.',
            ],

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

        foreach($positions as $position)
        {
            Position::create($position);
        }
    }
}
