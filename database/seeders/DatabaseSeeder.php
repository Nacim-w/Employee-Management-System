<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
$this->call(UsersSeeder::class);
$this->call(RolesSeeder::class);
$this->call(RoleUserSeeder::class);

       
    }
}
