<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DeleteBookRequest extends Request
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_id'           => 'required|exists:books,id',
            'user_id'           => 'required|exists:books,user_id'
        ];
    }
}
