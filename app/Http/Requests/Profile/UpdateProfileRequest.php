<?php

namespace eLibrary\Http\Requests\Profile;

use eLibrary\Http\Requests\Request;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Redirect user to page after authorize fails.
     *
     * @return mixed
     */
    public function forbiddenResponse()
    {
        return redirect(route('dashboard.index'))->with('form_response', json_encode([
            'type'    => 'danger',
            'message' => 'You are not authorized to use this form.',
        ]));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'current_password'      => 'sometimes|required_with:new_password,new_password_confirm|',
            'new_password'          => 'sometimes|required_with:current_password,new_password_confirm|min:6',
            'new_password_confirm'  => 'sometimes|required_with:current_password,new_password|same:new_password|min:6'
        ];
    }
}
