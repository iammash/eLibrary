<?php

namespace eLibrary\Http\Controllers;

use eLibrary\User;

class AdminController extends AuthenticatedController
{

    /**
     * @return $this
     */
    public function users()
    {
        $data = array();
        $data['user'] = $this->user;
        $data['users'] = User::where('id', '<>', $this->user->id)->get();
        return view('dashboard.users.index')->with($data);
    }

    public function settings()
    {
        return view('dashboard.settings');
    }
}
