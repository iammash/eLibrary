<?php

namespace eLibrary\Http\Controllers;

use eLibrary\Book;
use Illuminate\Http\Request;

use eLibrary\Http\Requests;
use Illuminate\Support\Facades\Input;

class AdminController extends AuthenticatedController
{

    public function books()
    {
        $data = array();
        $data['user'] = $this->user;
        $search_str   = Input::get('q');
        if( null === $search_str ) {
            $data['books'] = Book::paginate(20);
        } else {
            $data['books'] = Book::search($search_str)->paginate(20);
        }
        return view('dashboard.index')->with($data);
    }

    public function settings()
    {
        return view('dashboard.settings');
    }
}
