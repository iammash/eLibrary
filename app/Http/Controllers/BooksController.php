<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Book;

class BooksController extends AuthenticatedController
{

    public function index()
    {
        $user  = $this->user;
        $books = $user->books()->getResults();
        //dd($books);
        return view('dashboard.books.index', compact('user', 'books' ) );
    }

    public function add()
    {
        return view('dashboard.books.add');
    }

    public function edit( $book_id )
    {
        return view('dashboard.books.edit', $book_id);
    }

    public function view( $book_id )
    {
        return view('dashboard.books.show', $book_id);
    }

    public function delete( $book_id )
    {
        return view('dashboard.books.delete', $book_id);
    }
}
