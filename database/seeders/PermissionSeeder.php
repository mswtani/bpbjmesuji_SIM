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

            [
                'code' => 'users.approve',
                'name' => 'Setujui User',
                'description' => 'Menyetujui registrasi dan permohonan akun user.',
            ],

            [
                'code' => 'users.reject',
                'name' => 'Tolak User',
                'description' => 'Menolak registrasi dan permohonan akun user.',
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
                'description' => 'Mengubah konten yang masih dapat diedit.',
            ],

            [
                'code' => 'posts.update-published',
                'name' => 'Edit Konten Published',
                'description' => 'Mengubah konten yang sudah berstatus published.',
            ],

            [
                'code' => 'posts.publish',
                'name' => 'Publikasikan Konten',
                'description' => 'Mempublikasikan konten.',
            ],

            [
                'code' => 'posts.archive',
                'name' => 'Arsipkan Konten',
                'description' => 'Mengarsipkan konten.',
            ],

            [
                'code' => 'posts.restore',
                'name' => 'Pulihkan Konten',
                'description' => 'Mengembalikan konten yang diarsipkan menjadi draft.',
            ],

            [
                'code' => 'posts.delete',
                'name' => 'Hapus Konten',
                'description' => 'Menghapus konten, terutama konten berstatus draft.',
            ],

            /*
            |--------------------------------------------------------------------------
            | Helpdesk Management
            |--------------------------------------------------------------------------
            */

            [
                'code' => 'helpdesk.view',
                'name' => 'Lihat Helpdesk',
                'description' => 'Melihat daftar dan detail tiket Helpdesk.',
            ],

            [
                'code' => 'helpdesk.reply',
                'name' => 'Balas Helpdesk',
                'description' => 'Membalas pesan pada tiket Helpdesk.',
            ],

            [
                'code' => 'helpdesk.manage',
                'name' => 'Kelola Helpdesk',
                'description' => 'Mengelola status dan prioritas tiket Helpdesk.',
            ],


            /*
            |--------------------------------------------------------------------------
            | Regulation Type Management
            |--------------------------------------------------------------------------
            */

            [
                'code' => 'regulation-types.view',
                'name' => 'Lihat Jenis Regulasi',
                'description' => 'Melihat daftar jenis regulasi.',
            ],

            [
                'code' => 'regulation-types.create',
                'name' => 'Tambah Jenis Regulasi',
                'description' => 'Menambahkan jenis regulasi baru.',
            ],

            [
                'code' => 'regulation-types.update',
                'name' => 'Edit Jenis Regulasi',
                'description' => 'Mengubah informasi jenis regulasi.',
            ],

            [
                'code' => 'regulation-types.delete',
                'name' => 'Hapus Jenis Regulasi',
                'description' => 'Menghapus jenis regulasi yang tidak digunakan.',
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