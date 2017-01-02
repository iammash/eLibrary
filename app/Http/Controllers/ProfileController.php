<?php

namespace eLibrary\Http\Controllers;

use Illuminate\Http\Request;

use eLibrary\Http\Requests;

class ProfileController extends AuthenticatedController
{
    public function profile()
    {
        return view('dashboard.profile')->with('user', $this->user);
    }

    public function save(Requests\Profile\UpdateProfileRequest $request) {

        $this->user->firstname = $request->get('first_name');
        $this->user->lastname  = $request->get('last_name');

        if($request->has('new_password') && $request->has('new_password_confirm') && $request->has('current_password')) {

            if(!\Hash::check($request->get('current_password'), $this->user->password)){
                \Session::flash('form_response', json_encode(['type' => 'danger',
                    'message' => "The current password is invalid."]));
            } else {
                $this->user->password = bcrypt($request->get('new_password'));
            }
        }

        $this->user->save();

        \Session::flash('form_response', json_encode([
            'type' => 'success',
            'message' => 'Profile saved successfully!'
        ]));
        return redirect()->back();
    }
}
