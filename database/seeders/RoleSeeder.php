<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'edit content']);

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo(['manage users', 'edit content']);

        $editor = Role::create(['name' => 'Editor']);
        $editor->givePermissionTo('edit content');
    }
}
