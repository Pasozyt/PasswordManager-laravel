<?php

namespace Database\Seeders\Auth;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // uruchomienie konkretnego seedera
        // php artisan db:seed --class=RoleSeeder

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => config('app.admin_role')]);
        $user = Role::create(['name' => config('app.user_role')]);
    }
}
