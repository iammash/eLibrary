<?php

namespace App\Http\Requests;

use App\Book;
use App\Http\Requests\Request;
use App\Library;
use Auth;
use DB;

class UpdateBookRequest extends Request
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
        $book_id    = $request['book_id'];
        $library_id = $request['library_id'];
        
        return Book::userCan('delete', $user->id, $library_id, $book_id);
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
            'book_id'           => 'required|exists:books,id',
            'user_id'           => 'required|exists:books,user_id',
            'library_id'        => 'required|exists:libraries,id',
        ];
    }
}
