<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('code', 'SUPER_ADMIN')->firstOrFail();

        $position = Position::where('code', 'NON_PENYEDIA')->firstOrFail();

        User::firstOrCreate(

            [
                'email' => config('bpbj.default_admin.email'),
            ],

            [
                'role_id' => $role->id,

                'position_id' => $position->id,

                'nip' => config('bpbj.default_admin.nip'),

                'name' => config('bpbj.default_admin.name'),

                'phone' => config('bpbj.default_admin.phone'),

                'password' => config('bpbj.default_admin.password'),

                'must_change_password' => true,

                'is_active' => true,
            ]

        );
    }
}