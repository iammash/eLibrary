<?php

namespace App\Http\Requests\Books;

use App\Http\Requests\Request;
use Auth;
use App\Book;

class DeleteBookRequest extends Request
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
            'book_id'           => 'required|exists:books,id',
            'user_id'           => 'required|exists:books,user_id',
            'library_id'        => 'required|exists:libraries,id',
        ];
    }
}
