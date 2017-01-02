<?php

namespace eLibrary\Http\Controllers;
use Illuminate\Http\Request;
use eLibrary\Http\Requests;
use Auth;

class AuthenticatedController extends Controller
{
    /**
     * The current authenticated user
     * @var \eLibrary\User
     */
    protected $user = null;

    public function __construct()
    {
        $this->user = Auth::user();
    }
}
