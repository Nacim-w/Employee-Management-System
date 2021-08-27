<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
