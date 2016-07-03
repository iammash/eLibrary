<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;

class DashboardController extends AuthenticatedController
{
    public function index()
    {
        $totalbooks   =  Book::where('user_id', '=', $this->user->id)->count();
        $recentbooks  =  Book::where('user_id', '=', $this->user->id)->orderBy('created_at','desc')->take(3)->get();
        return view('dashboard.index', compact('recentbooks', 'totalbooks'));
    }

    public function settings()
    {
        
    }
}
