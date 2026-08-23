<?php

namespace Database\Seeders;

use App\Models\HelpdeskCategory;
use Illuminate\Database\Seeder;

class HelpdeskCategorySeeder extends Seeder
{
    /**
     * Seed kategori Helpdesk.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Aduan',
                'slug' => 'aduan',
                'description' => 'Penyampaian aduan terkait pelayanan atau permasalahan pengadaan barang dan jasa.',
                'is_active' => true,
                'sort_order' => 1,
            ],

            [
                'name' => 'Kritik',
                'slug' => 'kritik',
                'description' => 'Penyampaian kritik terhadap pelayanan atau pelaksanaan tugas terkait pengadaan barang dan jasa.',
                'is_active' => true,
                'sort_order' => 2,
            ],

            [
                'name' => 'Saran',
                'slug' => 'saran',
                'description' => 'Penyampaian saran dan masukan untuk peningkatan pelayanan.',
                'is_active' => true,
                'sort_order' => 3,
            ],

            [
                'name' => 'Konsultansi Pengadaan',
                'slug' => 'konsultansi-pengadaan',
                'description' => 'Konsultansi terkait pengadaan barang dan jasa pemerintah.',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            HelpdeskCategory::updateOrCreate(
                [
                    'slug' => $category['slug'],
                ],
                $category
            );
        }
    }
}