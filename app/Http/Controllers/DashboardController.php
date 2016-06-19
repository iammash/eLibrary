<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends AuthenticatedController
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function settings()
    {

    }
}
