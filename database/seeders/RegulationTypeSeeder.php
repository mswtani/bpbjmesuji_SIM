<?php

namespace Database\Seeders;

use App\Models\RegulationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegulationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Peraturan Daerah',
                'description' => 'Peraturan Daerah Kabupaten Mesuji.',
                'sort_order' => 10,
            ],

            [
                'name' => 'Peraturan Bupati',
                'description' => 'Peraturan Bupati Kabupaten Mesuji.',
                'sort_order' => 20,
            ],

            [
                'name' => 'Keputusan Bupati',
                'description' => 'Keputusan Bupati Kabupaten Mesuji.',
                'sort_order' => 30,
            ],

            [
                'name' => 'Instruksi Bupati',
                'description' => 'Instruksi Bupati Kabupaten Mesuji.',
                'sort_order' => 40,
            ],

            [
                'name' => 'Surat Edaran',
                'description' => 'Surat Edaran Pemerintah Kabupaten Mesuji.',
                'sort_order' => 50,
            ],

            [
                'name' => 'Surat Edaran Sekretariat Daerah',
                'description' => 'Surat Edaran yang diterbitkan oleh Sekretariat Daerah.',
                'sort_order' => 60,
            ],

            [
                'name' => 'Keputusan Sekretaris Daerah',
                'description' => 'Keputusan Sekretaris Daerah Kabupaten Mesuji.',
                'sort_order' => 70,
            ],
        ];

        foreach ($types as $type) {
            RegulationType::updateOrCreate(
                [
                    'name' => $type['name'],
                ],
                [
                    'slug' => Str::slug($type['name']),
                    'description' => $type['description'],
                    'sort_order' => $type['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}