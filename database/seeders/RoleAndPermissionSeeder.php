<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-approaches']);
        Permission::create(['name' => 'manage-posts']);
        Permission::create(['name' => 'manage-vrtools']);

        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['manage-approaches', 'manage-posts', 'manage-vrtools']);

        Role::create(['name' => 'writer']);
    }
}
