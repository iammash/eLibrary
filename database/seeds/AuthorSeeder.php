<?php

use Illuminate\Database\Seeder;
use App\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Charles E. Leiserson',
            'book_id' => 1
        ]);

        Author::create([
            'name' => 'Thomas H. Cormen',
            'book_id' => 1
        ]);

        Author::create([
            'name' => 'Clifford Stein',
            'book_id' => 1
        ]);

        Author::create([
            'name' => 'Ronald Rivest',
            'book_id' => 1
        ]);

        Author::create([
            'name' => 'Stuart J. Russell',
            'book_id' => 2,
        ]);

        Author::create([
            'name' => 'Peter Norvig',
            'book_id' => 2,
        ]);

        Author::create([
            'name' => 'Ramez Elmasri',
            'book_id' => 3,
        ]);

        Author::create([
            'name' => 'Fred Brooks',
            'book_id' => 3,
        ]);

        Author::create([
            'name' => 'Jeffrey Ullman',
            'book_id' => 4,
        ]);

        Author::create([
            'name' => 'Alfred Aho',
            'book_id' => 4,
        ]);

        Author::create([
            'name' => 'Monica S. Lam',
            'book_id' => 4,
        ]);

        Author::create([
            'name' => 'Ravi Sethi',
            'book_id' => 4,
        ]);

    }
}
