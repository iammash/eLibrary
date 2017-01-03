<?php

namespace eLibrary\Http\Controllers;

use eLibrary\Library;
use Illuminate\Http\Request;

use eLibrary\Http\Requests;
use eLibrary\Book;
use Activity;
use Illuminate\Support\Facades\Input;


class DashboardController extends AuthenticatedController
{
    public function index()
    {
        $data = array();

        //user stats
        $data['user']                   = $this->user;
        $data['user_total_libraries']   = $this->user->libraries()->count();
        $data['user_recent_libraries']  = $this->user->libraries()->orderBy('created_at','desc')->take(3)->get();
        $data['user_libraries_size']    = formatBytes($this->user->librariesSize(), 2);
        $data['user_files_count']       = $this->user->books()->count();

        //Admin stats
        if( $this->user->is_admin ) {
            $data['globaL_total_users_now'] = Activity::users()->count();
            $data['global_last_one_hour']   = Activity::users(60);
            $data['global_files_count']     = Book::all()->count();
            $data['global_total_libraries'] = Library::all()->count();
        }

        return view('dashboard.index')->with($data);
    }



    public function search()
    {
        $data = array(
            'q' => null,
            'libraries' => null,
            'books' => null,
        );
        $search_str = Input::get('q');
        if( null !== $search_str && "" !== $search_str ) {
            $data['q'] = $search_str;
            $data['libraries'] = Library::search($search_str)->paginate(15);
            $data['books'] = Book::search($search_str)->paginate(15);
        } else {
            return redirect()->to(route('dashboard.index'));
        }
        return view('dashboard.search.results')->with($data);
    }


    public function books()
    {
        $data = array();
        $data['user'] = $this->user;
        $search_str   = Input::get('q');
        if( null === $search_str ) {
            $data['books'] = Book::paginate(10);
        } else {
            $data['books'] = Book::search($search_str)->paginate(10);
        }
        $data['library'] = new \stdClass();
        $data['library']->id = -1;
        return view('dashboard.libraries.books.directory')->with($data);
    }
}
