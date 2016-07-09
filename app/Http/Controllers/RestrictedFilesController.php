<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use App\Book;

class RestrictedFilesController extends AuthenticatedController
{
    /**
     * Handles the route for displaying private files
     *
     * @param $user_id
     * @param $file_name
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($user_id, $file_name)
    {
        $file        = Book::where('file', '=', $file_name)->first();
        $canDownload = true;

        if( null === $file ){
            $canDownload = false;
        }

        if( $file->user_id !== $this->user->id || $this->user->id != $user_id ){
            $canDownload = false;
        }

        if( $canDownload ){
            $storagePath = storage_path('app/private/' . $user_id . '/' . $file_name);
            return response()->download($storagePath);
        } else {
            return redirect()->back();
        }

    }
}
