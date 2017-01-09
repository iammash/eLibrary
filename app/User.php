<?php

namespace eLibrary;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

/**
 *
 * Class User
 * @package App
 *
 * @property int id
 * @property string firstname
 * @property string lastname
 * @property string email
 * @property string password
 * @property int is_admin
 * @property string remember_token
 * @property string created_at
 * @property string updated_at
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'firstname', 'lastname', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Returns all documents for specific user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany('eLibrary\Book');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function libraries()
    {
        return $this->belongsToMany('eLibrary\Library', 'user_library', 'user_id', 'library_id');
    }

    /**
     * Returns the total user's library size
     * @return float|int
     */
    public function librariesSize() {
        $size = DB::table('books')->where('books.user_id', '=', $this->id)->sum('books.file_size');
        return $size;
    }

    /**
     * Returns the full name of the user
     * @return string
     */
    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Returns true if the user is admin
     * @return bool
     */
    public function isAdmin() {
        return (int)$this->is_admin === 1;
    }

    /**
     * If the user has access to the given book.
     *
     * @param $book
     * @return bool
     */
    public function hasMembershipAccessToBook( $book )
    {
        if( is_numeric( $book ) ) {
            $book_id = $book;
        } else {
            $book_id = $book->id;
        }

        return ((LibraryMembership::join('books', 'user_library.library_id', '=', 'books.library_id')
            ->where('user_library.user_id', '=', $this->id )
            ->whereIn('user_library.access', ['R','RW','RWD','MANAGER','OWNER'])
            ->where('books.id', '=', $book_id)->count()) > 0 || $this->isAdmin() );

    }

    public function hasMembershipAccessToBookRequested( $book )
    {
        if( is_numeric( $book ) ) {
            $book_id = $book;
        } else {
            $book_id = $book->id;
        }

        return ((LibraryMembership::join('books', 'user_library.library_id', '=', 'books.library_id')
                ->where('user_library.user_id', '=', $this->id )
                ->where('user_library.access', '=', 'REQUESTED')
                ->where('books.id', '=', $book_id)->count()) > 0 );
    }


    public static function removeCompletely( $user_id ) {

        $user = User::find( $user_id );
        if( null !== $user ) {

            //Remove books
            $books = Book::where('user_id','=',$user->id)->get();
            if( null !== $books && $books->count() > 0 ){
                foreach( $books as $book ) {
                    $book->removeCompletely();
                }
            }
            //Remove memberships
            LibraryMembership::where('user_id', '=', $user->id)->delete();

            //Remove libraries
            $libraries = Library::join('user_library', 'libraries.id', '=', 'user_library.library_id')
                ->whereIn('user_library.access', [Library::ACCESS_OWNER, Library::ACCESS_MANAGER])
                ->where('user_library.user_id', '=', $user->id)->select('libraries.*')->get();
            if( null !== $libraries && $libraries->count() > 0 ) {
                foreach($libraries as $library) {
                    $library->removeCompletely();
                }
            }

            self::destroy( $user->id );
        }
    }

}
