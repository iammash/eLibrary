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

}
