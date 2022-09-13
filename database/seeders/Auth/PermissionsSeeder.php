<?php

namespace Database\Seeders\Auth;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        // php artisan permission:cache-reset
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'log-viewer']);
        Permission::create(['name' => 'password.view']);

        // ADMINSTRATOR SYSTEMU
        $userRole = Role::findByName(config('app.admin_role'));
        $userRole->givePermissionTo('log-viewer');
        $userRole->givePermissionTo('password.view');

        $userRole = Role::findByName(config('app.user_role'));
        $userRole->givePermissionTo('password.view');
    }
}
