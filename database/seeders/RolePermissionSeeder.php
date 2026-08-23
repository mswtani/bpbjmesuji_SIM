<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Memberikan seluruh permission kepada SUPER_ADMIN.
     */
    public function run(): void
    {
        $superAdmin = Role::where('code', 'SUPER_ADMIN')->first();

        if (! $superAdmin) {
            return;
        }

        $permissionIds = Permission::pluck('id');

        $superAdmin->permissions()->sync(
            $permissionIds
        );

        $admin = Role::where('code', 'ADMIN')->first();

        if ($admin) {
            $adminPermissionIds = Permission::whereIn('code', [
                'helpdesk.view',
                'helpdesk.reply',
            ])->pluck('id');

            $admin->permissions()->syncWithoutDetaching(
                $adminPermissionIds
            );
        }
    }
}