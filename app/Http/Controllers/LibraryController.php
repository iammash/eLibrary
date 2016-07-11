<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Library;
use App\LibraryMembership;

class LibraryController extends AuthenticatedController
{

    /**
     * Renders the libraries index page
     *
     * @return mixed
     */
    public function index()
    {
        $user      = $this->user;
        $libraries = $this->user->libraries();
        return view('dashboard.libraries.index', compact( 'user', 'libraries' ) );
    }

    /**
     * Renders the library view page
     *
     * @param $library_id integer
     * @return mixed
     */
    public function view( $library_id )
    {
        return view('dashboard.libraries.view');
    }

    /**
     * Renders the library edit page
     *
     * @param $library_id integer
     * @return mixed
     */
    public function edit( $library_id )
    {
        $user    = $this->user;
        $library = Library::find( $library_id );
        return view('dashboard.libraries.edit', compact('library', 'user'));
    }

    /**
     * Renders the library delete page
     *
     * @param $library_id integer
     * @return mixed
     */
    public function delete( $library_id )
    {
        return view('dashboard.libraries.delete');
    }

    /**
     * Renders the 'create new' library page
     *
     * @return mixed
     */
    public function makeNew()
    {
        $user = $this->user;
        return view('dashboard.libraries.new', compact('user'));
    }

    /**
     * Handles the post request for creation new Library
     *
     * @param Requests\Libraries\CreateLibraryRequest $request
     */
    public function create( Requests\Libraries\CreateLibraryRequest $request )
    {
        $newLib = Library::create([
                    'name' => $request->get('library_name'),
                    'description' => $request->get('library_description')
                ]);

        if( $newLib instanceof Library ) {
            $members = $request->get('library_members');
            foreach ( $members as $member ) {
                LibraryMembership::create([
                    'user_id' => $member,
                    'library_id' => $newLib->id,
                ]);
            }
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'success',
                'message' => 'Your library has been created successfully!'
            ]));
        }

        return redirect()->back()->with('form_response', json_encode([
            'type' => 'danger',
            'message' => 'Internal Error during saving your Library.'
        ]));
    }

    /**
     * Handles the post request for updating Library
     *
     * @param Requests\Libraries\UpdateLibraryRequest $request
     */
    public function update( Requests\Libraries\UpdateLibraryRequest $request )
    {
        $library_id = $request->get('library_id');
        $library    = Library::find( $library_id );
        $library->name = $request->get('library_name');
        $library->description = $request->get('library_description');
        $members = $request->get('library_members');
        $library_members = $library->users()->get()->toArray();
        if(!empty($members) && count($members) > 0){

            foreach ($library_members as $m){
                if(!in_array($m, $members)) {
                    $_member = LibraryMembership::where('user_id', '=', $member)->where('library_id', '=', $library_id);
                    $_member->delete();
                }
            }

            foreach ($members as $member){
                $isMember = LibraryMembership::where('user_id', '=', $member)->where('library_id', '=', $library_id)->first()->exists();
                if( ! $isMember ) {
                    LibraryMembership::create([
                       'user_id' => $member,
                        'library_id' => $library_id
                    ]);
                }
            }
        }
    }

    /**
     * Handles the post request for removing Library
     *
     * @param Requests\Libraries\DeleteLibraryRequest $request
     */
    public function remove( Requests\Libraries\DeleteLibraryRequest $request )
    {

    }

}
