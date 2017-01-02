<?php

use Illuminate\Database\Seeder;
use eLibrary\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
           'id' => 1,
            'firstname' => 'Darko',
            'lastname' => 'Gjorgjijoski',
            'email' => 'dg@darkog.com',
            'password' => bcrypt('123456'),
            'is_admin' => true
        ]);

        User::create([
            'id' => 2,
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@doe.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'id' => 3,
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'email' => 'jane@doe.com',
            'password' => bcrypt('123456')
        ]);
    }
}
