<?php

namespace App\Http\Requests\Libraries;

use App\Http\Requests\Request;
use App\Library;
use Auth;

class UpdateLibraryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user       = Auth::user();
        $library_id = $this->request->get('library_id');
        return Library::userCan( 'edit', $user->id, $library_id );
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
            'library_name'        => 'required|max:255',
            'library_description' => 'required',
            'library_members'     => 'required',
            'library_id'          => 'required|exists:libraries,id'
        ];
    }
}
