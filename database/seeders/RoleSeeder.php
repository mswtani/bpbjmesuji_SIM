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
        $roles = [

            [
                'code' => 'SUPER_ADMIN',
                'name' => 'Super Administrator',
                'description' => 'Hak akses penuh terhadap seluruh sistem.',
                'level' => 100,
            ],

            [
                'code' => 'ADMIN',
                'name' => 'Administrator',
                'description' => 'Mengelola administrasi sistem.',
                'level' => 80,
            ],

            [
                'code' => 'USERS_MANAGER',
                'name' => 'Users Manager',
                'description' => 'Mengelola pengguna dan proses persetujuan akun ASN.',
                'level' => 70,
            ],

            [
                'code' => 'CONTENT_MANAGER',
                'name' => 'Content Manager',
                'description' => 'Mengelola berita, pengumuman, dan regulasi.',
                'level' => 60,
            ],

            [
                'code' => 'OPERATOR',
                'name' => 'Operator',
                'description' => 'Mengelola layanan operasional dan helpdesk.',
                'level' => 40,
            ],

            [
                'code' => 'AUDITOR',
                'name' => 'Auditor',
                'description' => 'Melakukan pengawasan dan audit terhadap data sistem.',
                'level' => 30,
            ],

            [
                'code' => 'PUBLIC_USER',
                'name' => 'Public User',
                'description' => 'Pengguna umum dan pelaku pengadaan yang melakukan registrasi mandiri.',
                'level' => 10,
            ],

        ];

        foreach ($roles as $role) {

            Role::updateOrCreate(
                ['code' => $role['code']],
                $role
            );

        }
    }
}