<?php

namespace eLibrary\Http\Controllers;

use eLibrary\Http\Requests\Users\UserDeleteRequest;
use Illuminate\View\View;
use Validator;
use eLibrary\User;

class AdminController extends AuthenticatedController
{

    /**
     * @return View
     */
    public function users()
    {
        $data = array();
        $data['user'] = $this->user;
        $data['users'] = User::where('id', '<>', $this->user->id)->get();
        return view('dashboard.users.index')->with($data);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteuser( UserDeleteRequest $request )
    {

        User::removeCompletely( $request->get('user_id') );

        return redirect()->back()->with('form_response', json_encode([
            'type' => 'success',
            'message' => 'User has been deleted successfully!'
        ]));

    }

    public function settings()
    {
        return view('dashboard.settings');
    }
}
