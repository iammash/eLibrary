<?php

namespace eLibrary\Http\Controllers;

use eLibrary\Library;
use Illuminate\Http\Request;

use eLibrary\Http\Requests;
use eLibrary\Book;
use Activity;


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


    public function settings()
    {
        return view('dashboard.settings');
    }
}
