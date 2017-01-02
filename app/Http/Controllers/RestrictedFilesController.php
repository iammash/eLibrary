<?php

namespace eLibrary\Http\Controllers;
use Illuminate\Http\Request;
use eLibrary\Http\Requests;
use Response;
use eLibrary\Book;
use League\Flysystem\File;

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

        if( $canDownload )
        {
            $storagePath = storage_path('app/private/' . $user_id . '/' . $file_name);

            if( file_exists( $storagePath ) )
            {
                //Send the file to console once authorized
                $file_contents = file_get_contents( $storagePath );
                return response()->make($file_contents, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="'.$file_name.'"'
                ] );
            }
        }

        return redirect()->back();
    }
}
