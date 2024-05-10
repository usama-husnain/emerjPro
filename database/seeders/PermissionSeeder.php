<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard_access',
            'dashboard_view',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_delete',
            'user_access',
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',
            'role_access',
            'role_view',
            'role_create',
            'role_edit',
            'role_delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
