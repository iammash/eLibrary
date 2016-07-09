<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Book;
use App\Genre;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;

class BooksController extends AuthenticatedController
{

    /**
     * Load the book index page
     * @return mixed
     */
    public function index()
    {
        $user  = $this->user;
        $books = $user->books()->getResults();
        return view('dashboard.books.index', compact('user', 'books' ) );
    }

    /**
     * Load the Add book page
     * @return mixed
     */
    public function add()
    {
        $genres = Genre::all();
        $user   = $this->user;
        return view('dashboard.books.add', compact('user', 'genres'));
    }

    /**
     * Handles the post request for updating existing book
     *
     * @param Requests\UpdateBookRequest $request
     * @return mixed
     */
    public function update( Requests\UpdateBookRequest $request )
    {
        $book               = Book::find( $request->get( 'book_id' ) );
        $book->title        = $request->get('book_title');
        $book->description  = $request->get('book_description');
        $book->genre_id     = $request->get('book_genre');
        $book->isbn         = $request->get('book_isbn');
        $book->publish_date = $request->get('book_publish_date');
        $book->publisher    = $request->get('book_publisher');
        $book->save();

        return redirect()->back()->with('form_response', json_encode([
            'type' => 'success',
            'message' => 'Your book has been updated successfully!'
        ]));
    }

    /**
     * Handles the post request for creation new Book
     *
     * @param Requests\CreateBookRequest $request
     * @return mixed
     */
    public function create( Requests\CreateBookRequest $request )
    {
        $file = $request->file('book_file');
        $result = Book::createBook($file->getPathname(), [
            'title'         => $request->get('book_title'),
            'description'   => $request->get('book_description'),
            'genre_id'      => $request->get('book_genre'),
            'isbn'          => $request->get('book_isbn'),
            'publish_date'  => $request->get('book_publish_date'),
            'publisher'     => $request->get('book_publisher'),
            'user_id'       => $request->user()->id
        ]);

        if( false === $result )
        {
            Session::flash('form_response', json_encode([
                'type' => 'danger',
                'message' => 'Error saving your form',
                'list' => ['Book can not be saved into the database due to internal error.']
            ]));
            return redirect()->back()->withInput( $request->except('file') );
        }
        else
        {
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'success',
                'message' => 'Your book is uploaded successfully!'
            ]));
        }
    }


    /**
     * @param $book_id
     * @return mixed
     */
    public function edit( $book_id )
    {
        $genres = Genre::all();
        $book = Book::find( $book_id );
        $user = $this->user;
        return view('dashboard.books.edit', compact('book', 'genres', 'user'));
    }

    /**
     * @param $book_id
     * @return mixed
     */
    public function view( $book_id )
    {
        $book = Book::find( $book_id );
        return view('dashboard.books.show', compact('book'));
    }

    /**
     * @param $book_id
     * @return mixed
     */
    public function delete( $book_id )
    {
        $book = Book::find( $book_id );
        return view('dashboard.books.delete', compact('book'));
    }
}
