<?php

namespace eLibrary;

/**
 *
 * Class Library
 * @package App
 *
 * @property int id
 * @property string name
 * @property string created_at
 * @property string updated_at
 */
class Library extends \Eloquent
{
    const ACCESS_SUSPENDED = 'SUSPENDED';
    const ACCESS_READ      = 'R';
    const ACCESS_WRITE     = 'RW';
    const ACCESS_DELETE    = 'RWD';
    const ACCESS_MANAGER   = 'MANAGER';
    const ACCESS_OWNER     = 'OWNER';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description'
    ];


    /**
     * Return all libraries that user is member
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('eLibrary\User', 'user_library', 'user_id', 'library_id');
    }


    /**
     * Return all books for this library
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function books()
    {
        return $this->hasMany('eLibrary\Book');
    }

    /**
     * @param $search_query
     * @return \Illuminate\Database\Query\Builder
     */
    public static function search( $search_query )
    {
        $search_query = explode(' ', $search_query);
        $query = \DB::table('libraries')->where('name', 'LIKE', '%'.$search_query[0].'%');
        if(count($search_query)>1){
            for($i = 1; $i < count($search_query); $i++){
                $query->orWhere('name', 'LIKE', '%'.$search_query[$i].'%');
            }
        }
        return $query;
    }


    /**
     * Returns the access meaning
     *
     * @param $r
     * @return string
     */
    public static function accessName( $r )
    {
        if( $r === self::ACCESS_SUSPENDED ){
            return 'Suspended';
        }

        if( $r === self::ACCESS_MANAGER ){
            return 'Manager';
        }

        if( $r === self::ACCESS_WRITE ){
            return 'Read/Write';
        }

        if( $r === self::ACCESS_DELETE ){
            return 'Read/Write/Delete';
        }

        if( $r === self::ACCESS_READ ){
            return 'Read';
        }

        if( $r === self::ACCESS_OWNER ){
            return 'Owner';
        }

        return '';
    }

    /**
     * Authorize user based on the roles
     *
     * @param $doWhat
     * @param $user_id
     * @param $library_id
     * @return bool
     */
    public static function userCan( $doWhat, $user_id, $library_id )
    {
        $membership = LibraryMembership::where('user_id', '=', $user_id)
                                        ->where('library_id', '=', $library_id)
                                        ->first();

        if( ! $membership->exists() ) {
            return false;
        }

        $user = User::find( $user_id );

        if( null === $user_id ) {
            return false;
        }

        if( $doWhat === 'view' ){

            return $membership->access == Library::ACCESS_READ
                || $membership->access == Library::ACCESS_WRITE
                || $membership->access == Library::ACCESS_DELETE
                || $membership->access == Library::ACCESS_MANAGER
                || $membership->access == Library::ACCESS_OWNER;
        }

        if( $doWhat === 'edit' ){

            return $membership->access == Library::ACCESS_WRITE
                || $membership->access == Library::ACCESS_DELETE
                || $membership->access == Library::ACCESS_MANAGER
                || $membership->access == Library::ACCESS_OWNER;
        }

        if( $doWhat === 'delete' ){

            return $membership->access == Library::ACCESS_DELETE
                || $membership->access == Library::ACCESS_MANAGER
                || $membership->access == Library::ACCESS_OWNER;
        }

        if( $doWhat === 'create' ){

            return $membership->access == Library::ACCESS_WRITE
                || $membership->access == Library::ACCESS_DELETE
                || $membership->access == Library::ACCESS_MANAGER
                || $membership->access == Library::ACCESS_OWNER;
        }

        if( $doWhat === 'everything' ) {
            return $membership->access == Library::ACCESS_WRITE
                || $membership->access == Library::ACCESS_DELETE
                || $membership->access == Library::ACCESS_MANAGER
                || $membership->access == Library::ACCESS_OWNER
                || $user->isAdmin();
        }

        return false;

    }

}
