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
        return $this->belongsToMany('App\Book');
    }

}
