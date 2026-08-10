<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Menambahkan permission dasar sistem.
     */
    public function run(): void
    {
        $permissions = [

            /*
            |--------------------------------------------------------------------------
            | User Management
            |--------------------------------------------------------------------------
            */

            [
                'code' => 'users.view',
                'name' => 'Lihat User',
                'description' => 'Melihat daftar dan detail user.',
            ],

            [
                'code' => 'users.create',
                'name' => 'Tambah User',
                'description' => 'Menambahkan user baru.',
            ],

            [
                'code' => 'users.update',
                'name' => 'Edit User',
                'description' => 'Mengubah data user.',
            ],

            [
                'code' => 'users.delete',
                'name' => 'Hapus User',
                'description' => 'Menghapus user.',
            ],

            [
                'code' => 'users.activate',
                'name' => 'Aktifkan User',
                'description' => 'Mengaktifkan kembali user yang tidak aktif.',
            ],

            [
                'code' => 'users.deactivate',
                'name' => 'Nonaktifkan User',
                'description' => 'Menonaktifkan user.',
            ],

            [
                'code' => 'users.reset-password',
                'name' => 'Reset Password User',
                'description' => 'Mereset password user.',
            ],


            /*
            |--------------------------------------------------------------------------
            | Role Management
            |--------------------------------------------------------------------------
            */

            [
                'code' => 'roles.view',
                'name' => 'Lihat Role',
                'description' => 'Melihat daftar dan detail role.',
            ],

            [
                'code' => 'roles.create',
                'name' => 'Tambah Role',
                'description' => 'Menambahkan role baru.',
            ],

            [
                'code' => 'roles.update',
                'name' => 'Edit Role',
                'description' => 'Mengubah data role.',
            ],

            [
                'code' => 'roles.delete',
                'name' => 'Hapus Role',
                'description' => 'Menghapus role yang tidak sedang digunakan.',
            ],


            /*
            |--------------------------------------------------------------------------
            | Content Management
            |--------------------------------------------------------------------------
            */

            [
                'code' => 'posts.view',
                'name' => 'Lihat Konten',
                'description' => 'Melihat daftar dan detail berita, pengumuman, dan regulasi.',
            ],

            [
                'code' => 'posts.create',
                'name' => 'Tambah Konten',
                'description' => 'Membuat berita, pengumuman, atau regulasi baru.',
            ],

            [
                'code' => 'posts.update',
                'name' => 'Edit Konten',
                'description' => 'Mengubah berita, pengumuman, atau regulasi.',
            ],

            [
                'code' => 'posts.publish',
                'name' => 'Publikasikan Konten',
                'description' => 'Mempublikasikan atau mengarsipkan konten.',
            ],

            [
                'code' => 'posts.delete',
                'name' => 'Hapus Konten',
                'description' => 'Menghapus berita, pengumuman, atau regulasi.',
            ],
        ];


        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['code' => $permission['code']],
                $permission
            );
        }
    }
}