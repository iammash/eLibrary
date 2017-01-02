<?php

use Illuminate\Database\Seeder;
use eLibrary\Library;
use eLibrary\LibraryMembership;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('libraries')->truncate();
        DB::table('user_library')->truncate();

        Library::create([
            'id'   => 1,
            'name' => 'School eLibrary',
            'description' => 'eLibrary created for students in our school.'
        ]);

        Library::create([
            'id'   => 2,
            'name' => 'Computer Science eLib',
            'description' => 'eLibrary created for students in our computer science class.'
        ]);

        LibraryMembership::create([
            'user_id' => 1,
            'library_id' => 1,
            'access' => Library::ACCESS_OWNER
        ]);

        LibraryMembership::create([
            'user_id' => 2,
            'library_id' => 1,
            'access' => Library::ACCESS_READ
        ]);

        LibraryMembership::create([
            'user_id' => 3,
            'library_id' => 1,
            'access' => Library::ACCESS_WRITE
        ]);
        
        LibraryMembership::create([
            'user_id' => 1,
            'library_id' => 2,
            'access' => Library::ACCESS_MANAGER
        ]);

    }
}
