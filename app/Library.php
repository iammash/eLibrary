<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }


    /**
     * Return all books for this library
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->hasMany('App\Book');
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

}
