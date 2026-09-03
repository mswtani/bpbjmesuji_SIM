<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::where(
            'code',
            'SUPER_ADMIN'
        )->first();

        if ($superAdmin) {

            $superAdmin->permissions()->sync(
                Permission::pluck('id')
            );

        }


        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        $admin = Role::where(
            'code',
            'ADMIN'
        )->first();

        if ($admin) {

            $permissions = Permission::whereIn(
                'code',
                [

                    // Users
                    'users.view',
                    'users.create',
                    'users.update',
                    'users.activate',
                    'users.deactivate',
                    'users.reset-password',

                    // Roles
                    'roles.view',

                   // Posts
                    'posts.view',
                    'posts.create',
                    'posts.update',
                    'posts.update-published',
                    'posts.publish',
                    'posts.archive',
                    'posts.restore',
                    'posts.delete',

                    // Regulation Types
                    'regulation-types.view',
                    'regulation-types.create',
                    'regulation-types.update',
                    'regulation-types.delete',

                ]
            )->pluck('id');

            $admin->permissions()->sync(
                $permissions
            );

        }


        /*
        |--------------------------------------------------------------------------
        | USERS MANAGER
        |--------------------------------------------------------------------------
        */

        $usersManager = Role::where(
            'code',
            'USERS_MANAGER'
        )->first();

        if ($usersManager) {

            $permissions = Permission::whereIn(
                'code',
                [

                    'users.view',
                    'users.create',
                    'users.update',
                    'users.activate',
                    'users.deactivate',
                    'users.reset-password',

                    // ASN Registration Approval
                    'users.approve',
                    'users.reject',

                ]
            )->pluck('id');

            $usersManager->permissions()->sync(
                $permissions
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CONTENT MANAGER
        |--------------------------------------------------------------------------
        */

        $contentManager = Role::where(
            'code',
            'CONTENT_MANAGER'
        )->first();

        if ($contentManager) {

            $permissions = Permission::whereIn(
                'code',
                [

                    // Posts
                    'posts.view',
                    'posts.create',
                    'posts.update',
                    'posts.update-published',
                    'posts.publish',
                    'posts.archive',
                    'posts.restore',
                    'posts.delete',

                    // Regulation Types
                    'regulation-types.view',
                    'regulation-types.create',
                    'regulation-types.update',
                    'regulation-types.delete',

                ]
            )->pluck('id');

            $contentManager->permissions()->sync(
                $permissions
            );
        }


        /*
        |--------------------------------------------------------------------------
        | OPERATOR
        |--------------------------------------------------------------------------
        */

        $operator = Role::where(
            'code',
            'OPERATOR'
        )->first();

        if ($operator) {

            $permissions = Permission::whereIn(
                'code',
                [

                    'helpdesk.view',
                    'helpdesk.reply',
                    'helpdesk.manage',

                ]
            )->pluck('id');

            $operator->permissions()->sync(
                $permissions
            );

        }


        /*
        |--------------------------------------------------------------------------
        | AUDITOR
        |--------------------------------------------------------------------------
        */

        $auditor = Role::where(
            'code',
            'AUDITOR'
        )->first();

        if ($auditor) {

            $permissions = Permission::whereIn(
                'code',
                [

                    'posts.view',
                    'helpdesk.view',

                ]
            )->pluck('id');

            $auditor->permissions()->sync(
                $permissions
            );

        }
    }
}