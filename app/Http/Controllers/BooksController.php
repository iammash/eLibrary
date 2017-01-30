<?php

namespace eLibrary\Http\Controllers;

use eLibrary\Library;
use Illuminate\Http\Request;
use eLibrary\Http\Requests;
use eLibrary\Book;
use eLibrary\Genre;
use Session;

class BooksController extends AuthenticatedController
{

    /**
     * Renders the book index page
     *
     * @param $library_id
     * @return mixed
     */
    public function index( $library_id )
    {
        $library = Library::find( $library_id );
        $user    = $this->user;
        $books   = $user->books()->where('library_id', '=', $library_id)->getResults();
        return view('dashboard.libraries.books.index', compact('user', 'library', 'books' ) );
    }

    /**
     * Renders the Add book page
     * @return mixed
     */
    public function add( $library_id )
    {
        $genres = Genre::all();
        $user   = $this->user;
        //TODO: Access control needed for library. Not every user can access every library.
        $library = Library::find( $library_id );
        return view('dashboard.libraries.books.add', compact('library',  'user', 'genres'));
    }


    /**
     * Renders the edit resource page
     *
     * @param $book_id
     * @return mixed
     */
    public function edit( $library_id, $book_id )
    {
        $genres = Genre::all();
        $user = $this->user;

		if(!Library::userCan('edit', $this->user->id, $library_id)){
			return redirect()->back()->with('form_response', json_encode([
				'type'    => 'warning',
				'message' => 'You are not authorized to edit this book.',
			]));
		}

        $library = Library::find( $library_id );
        $book = Book::where( 'id', '=', $book_id )
            ->where('library_id', '=', $library_id)
            ->first();
        return view('dashboard.libraries.books.edit', compact('library', 'book', 'genres', 'user'));
    }

    /**
     * Renders the view resource page
     *
     * @param $book_id
     * @return mixed
     */
    public function view( $library_id, $book_id )
    {

		if(!Book::userCan('edit', $this->user->id, $library_id, $book_id)){
			return redirect()->back()->with('form_response', json_encode([
				'type'    => 'warning',
				'message' => 'You are not authorized to view this book.',
			]));
		}

        $library = Library::find( $library_id );
        $book = Book::where( 'id', '=', $book_id )
            ->where('library_id', '=', $library_id)
            ->first();
        return view('dashboard.libraries.books.view', compact('library', 'book'));
    }

    /**
     * Renders the delete resource page
     *
     * @param $book_id
     * @return mixed
     */
    public function delete( $library_id, $book_id )
    {
        $book = Book::where( 'id', '=', $book_id )
            ->where('user_id', '=', $this->user->id)
            ->where('library_id', '=', $library_id)
            ->first();


		if(!Book::userCan('edit', $this->user->id, $library_id, $book_id)){
			return redirect()->back()->with('form_response', json_encode([
				'type'    => 'warning',
				'message' => 'You are not authorized to delete this book.',
			]));
		}
        $library = Library::find( $library_id );

        $user = $this->user;

        if(  null === $book ){
            Session::flash('form_response', json_encode(['type' => 'danger', 'message' => "You don't have access to remove this item."]));
            return redirect()->back();
        }

        return view('dashboard.libraries.books.delete', compact('library', 'book', 'user'));
    }


    /**
     * Handles the post request for updating existing book
     *
     * @param Requests\Books\UpdateBookRequest $request
     * @return mixed
     */
    public function update( Requests\Books\UpdateBookRequest $request )
    {
        $book               = Book::find( $request->get( 'book_id' ) );
        $book->title        = $request->get('book_title');
        $book->description  = $request->get('book_description');
        $book->genre_id     = $request->get('book_genre');
        $book->isbn         = $request->get('book_isbn');
        $book->publish_date = $request->get('book_publish_date');
        $book->publisher    = $request->get('book_publisher');
        $book->library_id   = $request->get('library_id');
        $book->save();

        return redirect()->back()->with('form_response', json_encode([
            'type' => 'success',
            'message' => 'Your book has been updated successfully!'
        ]));
    }

    /**
     *  Handles the post request for creation new Book
     *
     * @param Requests\Books\CreateBookRequest $request
     * @return mixed
     */
    public function create( Requests\Books\CreateBookRequest $request )
    {
        $file = $request->file('book_file');
        $result = Book::createBook($file->getPathname(), [
            'title'         => $request->get('book_title'),
            'description'   => $request->get('book_description'),
            'genre_id'      => $request->get('book_genre'),
            'isbn'          => $request->get('book_isbn'),
            'publish_date'  => $request->get('book_publish_date'),
            'publisher'     => $request->get('book_publisher'),
            'library_id'    => $request->get('library_id'),
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
     * Handles removing resource from the database
     *
     * @param Requests\Books\DeleteBookRequest $request
     * @return mixed
     */
    public function remove( Requests\Books\DeleteBookRequest $request )
    {
        $book_id = $request->get('book_id');
        $book    = Book::find( $book_id );

        $deleted = $book->delete();

        if( $deleted || null === $deleted )
        {
            return redirect(route('dashboard.index'))->with('form_response', json_encode([
                'type' => 'success',
                'message' => 'Book deleted successfully.'
            ]));
        }

        return redirect()->back()->with('form_response', json_encode([
            'type' => 'danger',
            'message' => 'Book can not be deleted.'
        ]));

    }

}
