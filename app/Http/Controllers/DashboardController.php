<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;
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
        $data['user_files_count']       = 15;




        //Admin stats
        $data['globaL_total_users_now'] = Activity::users()->count();
        $data['global_last_one_hour']   = Activity::users(60);
        $data['global_files_count']     = Book::all()->count();
        $data['global_total_libraries'] = 10;

        return view('dashboard.index')->with($data);
    }

    public function settings()
    {
        
    }
}
