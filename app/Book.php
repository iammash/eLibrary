<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 * @package App
 */
class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'genre_id', 'cover_image', 'isbn', 'publisher', 'file', 'publish_date', 'description', 'user_id',
    ];

    /**
     * Return all authors for this book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authors()
    {
        return $this->hasMany('App\Author');
    }

    /**
     * Get the genre record associated with the user.
     */
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
}
