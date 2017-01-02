<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UserSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(LibrarySeeder::class);
        $this->call(BookSeeder::class);
        $this->call(AuthorSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
