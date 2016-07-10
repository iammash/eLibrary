<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;

class DashboardController extends AuthenticatedController
{
    public function index()
    {
        $user             = $this->user;
        $total_libraries  = $this->user->libraries()->count();
        $recent_libraries = $user->libraries()->orderBy('created_at','desc')->take(3)->get();
        return view('dashboard.index', compact('recent_libraries', 'total_libraries', 'user'));
    }
    

    public function settings()
    {
        
    }
}
