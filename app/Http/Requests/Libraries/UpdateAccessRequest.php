<?php

namespace eLibrary\Http\Requests\Libraries;

use eLibrary\Http\Requests\Request;
use eLibrary\Library;

class UpdateAccessRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $library_id = $this->request->get('library_id');
        return (\Auth::check() && Library::userCan( 'everything', \Auth::user()->id, $library_id ));
    }

    /**
     * Redirect user to page after authorize fails.
     *
     * @return mixed
     */
    public function forbiddenResponse()
    {
        return redirect(route('dashboard.books'))->with('form_response', json_encode([
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
            'library_id'     => 'numeric|exists:libraries,id',
            'user_id'        => 'numeric|exists:users,id',
        ];
    }
}
