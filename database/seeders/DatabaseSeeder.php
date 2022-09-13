<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PasswordSeeder;
use Database\Seeders\Auth\RolesSeeder;
use Database\Seeders\Auth\UsersSeeder;
use Database\Seeders\Auth\PermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // wypełnienie bazy
        // polecenie  php artisan db:seed
        // php artisan migrate:fresh --seed
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UsersSeeder::class);

        $this->call(PasswordSeeder::class);
    }
}
