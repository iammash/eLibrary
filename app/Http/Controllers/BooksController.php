<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BooksController extends AuthenticatedController
{

    public function index()
    {
        return view('dashboard.books.index');
    }

    public function add()
    {
        return view('dashboard.books.add');
    }

    public function edit( $document_id )
    {
        return view('dashboard.books.edit', $document_id);
    }
}
