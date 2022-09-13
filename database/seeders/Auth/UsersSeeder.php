<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin Testowy',
            'email' => 'admin@localhost',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('12345678'),
        ]);
        $adminRole = Role::findByName(config('app.admin_role'));
        if (isset($adminRole)) {
            $user->assignRole($adminRole);
        }

        $user = User::create([
            'name' => 'User Testowy',
            'email' => 'user@localhost',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('12345678'),
        ]);
        $userRole = Role::findByName(config('app.user_role'));
        if (isset($userRole)) {
            $user->assignRole($userRole);
        }
    }
}
