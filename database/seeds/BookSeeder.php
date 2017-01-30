<?php

use Illuminate\Database\Seeder;
use eLibrary\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->truncate();

        Book::createBook( self::getDemoDataDirectory('1181818183.pdf'), [
            'id' => 1,
            'title' => 'Introduction to Algorithms',
            'genre_id' => 5,
            'isbn' => '9780262032933',
            'publisher' => 'MIT Press',
            'publish_date' => '14/07/1990',
            'description' => 'Introduction to Algorithms is a book by Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, and Clifford Stein.',
            'file' => '1181818183.pdf',
            'library_id' => 2,
            'user_id' => 1,
        ], Book::FILE_COPY);

        Book::createBook( self::getDemoDataDirectory('2343928492.pdf'), [
            'id' => 2,
            'title' => 'Artificial Intelligence: A Modern Approach',
            'genre_id' => 5,
            'isbn' => '9781299747371',
            'publisher' => 'Prentice Hall',
            'publish_date' => '13/12/1994',
            'description' => 'Artificial Intelligence: A Modern Approach is a university textbook on artificial intelligence, written by Stuart J. Russell and Peter Norvig. The third edition of the book was released 11 December 2009',
            'file' => '2343928492.pdf',
            'library_id' => 2,
            'user_id' => 1,
        ], Book::FILE_COPY);

        Book::createBook( self::getDemoDataDirectory('3248932432.pdf'), [
            'id' => 3,
            'title' => 'Fundamentals of Database Systems',
            'genre_id' => 5,
            'isbn' => '9780136086208',
            'publisher' => 'Pearson; 6 edition',
            'publish_date' => '09/04/2010',
            'description' => 'Clear explanations of theory and design, broad coverage of models and real systems, and an up-to-date introduction to modern database technologies result in a leading introduction to database systems.',
            'file' => '3248932432.pdf',
            'library_id' => 2,
            'user_id' => 1,
        ], Book::FILE_COPY);

        Book::createBook( self::getDemoDataDirectory('3249324823.pdf'), [
            'id' => 4,
            'title' => 'The Mythical Man-Month',
            'genre_id' => 5,
            'isbn' => '0-201-00650-2',
            'publisher' => 'Addison-Wesley',
            'publish_date' => '01/01/1975',
            'description' => 'The Mythical Man-Month: Essays on Software Engineering is a book on software engineering and project management by Fred Brooks, whose central theme is that "adding manpower to a late software project makes it later',
            'file' => '3249324823.pdf',
            'library_id' => 1,
            'user_id' => 1,
        ], Book::FILE_COPY);

        Book::createBook( self::getDemoDataDirectory('9898911919.pdf'), [
            'id' => 5,
            'title' => 'Compilers: Principles, Techniques, and Tools',
            'genre_id' => 5,
            'isbn' => '9780262032933',
            'publisher' => 'Pearson Education',
            'publish_date' => '01/01/1986',
            'description' => 'Compilers: Principles, Techniques, and Tools is a computer science textbook by Alfred V. Aho, Monica S. Lam, Ravi Sethi, and Jeffrey D. Ullman about compiler construction.',
            'file' => '9898911919.pdf',
            'library_id' => 2,
            'user_id' => 1,
        ], Book::FILE_COPY);


		Book::createBook( self::getDemoDataDirectory('239492349212.pdf'), [
			'id' => 6,
			'title' => 'Discrete Mathematics and its applications',
			'genre_id' => 5,
			'isbn' => '9780073383095',
			'publisher' => 'Kenneth H Rosen',
			'publish_date' => '05/06/2007',
			'description' => 'A discrete mathematics course has more than one purpose. Students should learn a particular set of mathematical facts and how to apply them;',
			'file' => '239492349212.pdf',
			'library_id' => 3,
			'user_id' => 5,
		], Book::FILE_COPY);

    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getDemoDataDirectory( $fileName )
    {
        return storage_path('app/private') . '/DemoData/' . $fileName;
    }
}
