<?php

namespace eLibrary\Http\Controllers;

use eLibrary\Book;
use eLibrary\Http\Requests;
use eLibrary\Library;
use eLibrary\LibraryMembership;
use eLibrary\User;

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
        $libraries = $this->user->libraries()->where('user_library.access', '<>', 'REQUESTED');
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
        $membership = LibraryMembership::where('user_id', '=', $this->user->id)->where('library_id', '=', $library_id)->first();
        $data = array();
        $data['user']    = $this->user;
        $data['library'] = Library::find( $library_id );
        $data['books']   = $data['library']->books();
        $data['member_since'] = $membership->created_at;
        $data['access'] = $membership->access;
        $data['members'] = User::join('user_library', 'users.id', '=', 'user_library.user_id')
            ->where('user_library.library_id','=',$library_id)
            ->whereNotIn('user_library.access', [Library::ACCESS_MANAGER,Library::ACCESS_OWNER,Library::ACCESS_REQUESTED])
            ->get();
        $data['requests'] = $data['library']->users()->where('user_library.access', '=', 'REQUESTED')->get();

        $data['non_member_users'] = LibraryMembership::availableForMembership( $library_id );

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

            LibraryMembership::create([
                'user_id' => $request->user()->id,
                'library_id' => $newLib->id,
                'access' => Library::ACCESS_MANAGER
            ]);

            $members = $request->get('library_members');
            foreach ( $members as $member ) {
                LibraryMembership::create([
                    'user_id' => $member,
                    'library_id' => $newLib->id,
                    'access' => Library::ACCESS_READ
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
     * @param Requests\Libraries\ReqAccessRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestAccessFromBook( Requests\Libraries\ReqAccessRequest $request )
    {
        if( ! $request->user()->hasMembershipAccessToBook( $request->get('book_id') ) ) {
            $book = $request->get('book_id');
            $book = Book::find($book);
            LibraryMembership::create([
                'library_id' => $book->library_id,
                'user_id' => $request->user()->id,
                'access' => 'REQUESTED',
            ]);
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'info',
                'message' => 'Access has been requested. Please wait some time until library owner verifies your membership.'
            ]));
        } else {
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'danger',
                'message' => 'User has access to the book already.'
            ]));
        }
    }

    /**
     * @param Requests\Libraries\UpdateAccessRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveAccess(Requests\Libraries\UpdateAccessRequest $request) {

        $user_id = $request->get('user_id');
        $libr_id = $request->get('library_id');

        $pending_membership = LibraryMembership::where('user_id', '=', $user_id )
            ->where('library_id', '=', $libr_id)
            ->first();

        if( null !== $pending_membership ) {
            $pending_membership->access = Library::ACCESS_READ;
            $pending_membership->save();
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'success',
                'message' => 'Membership has been approved successfully.'
            ]));

        } else {
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'danger',
                'message' => 'Error happened while approving user membership.'
            ]));
        }

    }

    public function restrictAccess(Requests\Libraries\UpdateAccessRequest $request) {

        $user_id = $request->get('user_id');
        $libr_id = $request->get('library_id');

        $existing_membership = LibraryMembership::where('user_id', '=', $user_id )
            ->where('library_id', '=', $libr_id)
            ->first();

        if( null !== $existing_membership ) {

            $existing_membership->forceDelete();

            return redirect()->back()->with('form_response', json_encode([
                'type' => 'success',
                'message' => 'Member has been removed successfully.'
            ]));

        } else {
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'danger',
                'message' => 'Error happened while restricting user membership.'
            ]));
        }
    }


    /**
     * @param Requests\Libraries\UpdateAccessRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addtolibrary( Requests\Libraries\UpdateAccessRequest $request ) {

        $user_id = $request->get('user_id');
        $libr_id = $request->get('library_id');
        $access  = $request->get('access');

        $existing_membership = LibraryMembership::where('user_id', '=', $user_id )
            ->where('library_id', '=', $libr_id)
            ->first();

        if( null === $existing_membership ) {
            LibraryMembership::create([
                'library_id' => $libr_id,
                'user_id' => $user_id,
                'access' => $access,
            ]);
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'info',
                'message' => 'User has been added to the library!'
            ]));
        } else {
            return redirect()->back()->with('form_response', json_encode([
                'type' => 'danger',
                'message' => 'User has access to the library already.'
            ]));
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
