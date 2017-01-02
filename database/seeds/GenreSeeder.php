<?php

use Illuminate\Database\Seeder;
use eLibrary\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->truncate();

        Genre::create([ 'id' => 1, 'title' => 'Drama' ]);
        Genre::create([ 'id' => 2, 'title' => 'Romance' ]);
        Genre::create([ 'id' => 3, 'title' => 'Horror' ]);
        Genre::create([ 'id' => 4, 'title' => 'SCI-Fi' ]);
        Genre::create([ 'id' => 5, 'title' => 'Educational' ]);
    }
}
