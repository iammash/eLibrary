<?php

namespace eLibrary\Http\Controllers;

use eLibrary\Http\Requests;
use eLibrary\Library;
use eLibrary\LibraryMembership;

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
        $data = array();
        $data['user']    = $this->user;
        $data['library'] = Library::find( $library_id );
        $data['books']   = $data['library']->books();

        //dd($data['books']->get()->first()->id);

        return view('dashboard.libraries.view')->with($data);
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
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Requests\Libraries\UpdateLibraryRequest $request )
    {
        $library_id       = $request->get('library_id');

        $existing_members = LibraryMembership::where('library_id', '=', $library_id)
            ->where('user_library.access', '<>', 'OWNER')
            ->where('user_library.access', '<>', 'MANAGER')->get();

        $lib_members      = array_values($request->get('library_members'));

        foreach($existing_members as $membership)
        {
            if(!in_array($membership->user_id, $lib_members))
            {
                LibraryMembership::where('library_id', '=', $library_id)
                    ->where('user_id', '=', $membership->user_id)
                    ->delete();
            }
        }

        foreach($lib_members as $new_member)
        {
            $notexists = false;
            foreach($existing_members as $old_membership)
            {
                if( $old_membership->user_id === $new_member )
                {
                    $notexists = true;
                }
            }

            if( ! $notexists )
            {
                LibraryMembership::create(array(
                    'library_id' => $library_id,
                    'user_id' => $new_member,
                    'access' => 'R',
                ));
            }

        }

        return redirect()->back()->with('form_response', json_encode([
            'type' => 'success',
            'message' => 'Your library has been updated successfully!'
        ]));

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
