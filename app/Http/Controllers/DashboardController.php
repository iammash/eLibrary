<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;

class DashboardController extends AuthenticatedController
{
    public function index()
    {
        $user         = $this->user;
        $totalbooks   =  Book::where('user_id', '=', $this->user->id)->count();
        $recentbooks  =  $user->books()->orderBy('created_at','desc')->take(3)->get();
        return view('dashboard.index', compact('recentbooks', 'totalbooks', 'user'));
    }

    public function settings()
    {
        
    }
}
