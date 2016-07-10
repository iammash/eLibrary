<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use App\Book;

class CreateBookRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //this is validated in the rules already
        $request    = $this->request->all();
        $user       = Auth::user();
        $library_id = $request['library_id'];
        
        return Book::userCan('create', $user->id, $library_id, null);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_title'        => 'required|max:255',
            'book_description'  => 'required',
            'book_genre'        => 'required',
            'book_isbn'         => 'required',
            'book_publish_date' => 'required',
            'book_publisher'    => 'required',
            'book_file'         => 'required',
            'library_id'        => 'required|exists:libraries,id',
        ];
    }
}
