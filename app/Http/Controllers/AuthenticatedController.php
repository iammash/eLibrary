<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class AuthenticatedController extends Controller
{
    /**
     * The current authenticated user
     * @var \App\User
     */
    protected $user = null;

    public function __construct()
    {
        $this->user = Auth::user();
    }
}
