<?php

use Illuminate\Database\Seeder;
use App\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'id' => 1,
            'title' => 'Introduction to Algorithms',
            'genre_id' => 5,
            'isbn' => '9780262032933',
            'publisher' => 'MIT Press',
            'publish_date' => '14/07/1990',
            'description' => 'Introduction to Algorithms is a book by Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, and Clifford Stein.',
            'file' => '1181818183.pdf',
            'user_id' => 1,
        ]);

        Book::create([
            'id' => 2,
            'title' => 'Artificial Intelligence: A Modern Approach',
            'genre_id' => 5,
            'isbn' => '9781299747371',
            'publisher' => 'Prentice Hall',
            'publish_date' => '13/12/1994',
            'description' => 'Artificial Intelligence: A Modern Approach is a university textbook on artificial intelligence, written by Stuart J. Russell and Peter Norvig. The third edition of the book was released 11 December 2009',
            'file' => '2343928492.pdf',
            'user_id' => 1,
        ]);

        Book::create([
            'id' => 3,
            'title' => 'Fundamentals of Database Systems',
            'genre_id' => 5,
            'isbn' => '9780136086208',
            'publisher' => 'Pearson; 6 edition',
            'publish_date' => '09/04/2010',
            'description' => 'Clear explanations of theory and design, broad coverage of models and real systems, and an up-to-date introduction to modern database technologies result in a leading introduction to database systems.',
            'file' => '3248932432.pdf',
            'user_id' => 1,
        ]);

        Book::create([
            'id' => 4,
            'title' => 'The Mythical Man-Month',
            'genre_id' => 5,
            'isbn' => '0-201-00650-2',
            'publisher' => 'Addison-Wesley',
            'publish_date' => '01/01/1975',
            'description' => 'The Mythical Man-Month: Essays on Software Engineering is a book on software engineering and project management by Fred Brooks, whose central theme is that "adding manpower to a late software project makes it later',
            'file' => '3249324823.pdf',
            'user_id' => 1,
        ]);

        Book::create([
            'id' => 5,
            'title' => 'Compilers: Principles, Techniques, and Tools',
            'genre_id' => 5,
            'isbn' => '9780262032933',
            'publisher' => 'Pearson Education',
            'publish_date' => '01/01/1986',
            'description' => 'Compilers: Principles, Techniques, and Tools is a computer science textbook by Alfred V. Aho, Monica S. Lam, Ravi Sethi, and Jeffrey D. Ullman about compiler construction.',
            'file' => '9898911919.pdf',
            'user_id' => 1,
        ]);
    }
}