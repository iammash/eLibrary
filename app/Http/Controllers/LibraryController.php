<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;
use App\Http\Requests;

class LibraryController extends AuthenticatedController
{
    public function index()
    {
        $user      = $this->user;
        $libraries = $this->user->libraries();
        return view('dashboard.libraries.index', compact( 'user', 'libraries' ) );
    }

    public function view( $library_id )
    {
        return view('dashboard.libraries.view');
    }

    public function edit( $library_id )
    {
        return view('dashboard.libraries.edit');
    }

    public function delete( $library_id )
    {
        return view('dashboard.libraries.delete');
    }

    public function makeNew()
    {
        return view('dashboard.libraries.new');
    }

}
