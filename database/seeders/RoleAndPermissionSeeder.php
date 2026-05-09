<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'manage-users']);
        Permission::firstOrCreate(['name' => 'manage-approaches']);
        Permission::firstOrCreate(['name' => 'manage-posts']);
        Permission::firstOrCreate(['name' => 'manage-vrtools']);
        Permission::firstOrCreate(['name' => 'manage-categories']);

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(['manage-approaches', 'manage-posts', 'manage-vrtools', 'manage-categories']);

        $writer = Role::firstOrCreate(['name' => 'writer']);
        $writer->givePermissionTo(['manage-posts', 'manage-vrtools']);
    }
}
