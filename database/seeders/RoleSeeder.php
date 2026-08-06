<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'code' => 'SUPER_ADMIN',
            'name' => 'super administrator',
            'description' => 'Hak akses penuh terhadap sistem',
            'level' => 100,
        ]);
        
        
        Role::create([
            'code' => 'ADMIN',
            'name' => 'administrator',
            'description' => 'Mengelola data pengguna',
            'level' => 80,
        ]);

        
        Role::create([
            'code' => 'EDITOR',
            'name' => 'Editor',
            'description' => 'Mengelola dan mempulikasikan konten',
            'level' => 60,
        ]);
        
        
        Role::create([
            'code' => 'OPERATOR',
            'name' => 'operator',
            'description' => 'Mengelola konsultansi dan layanan',
            'level' => 40,
        ]);
    }
}
