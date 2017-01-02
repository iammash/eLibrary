<?php

namespace eLibrary\Http\Requests\Books;

use eLibrary\Book;
use eLibrary\Http\Requests\Request;
use Auth;

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
        
        return Book::userCan('edit', $user->id, $library_id, $book_id);
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
