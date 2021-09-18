<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Alex',
            'email' => 'radu.c.alexandru@gmail.com',
            'password' => Hash::make('pulamea123'),
            'role_id' => 1
        ]);
        $this->call([
            RoleSeeder::class
        ]);
    }
}
