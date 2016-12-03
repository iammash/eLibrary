<?php

namespace App;

/**
 *
 * Class Author
 * @package App
 *
 * @property int id
 * @property string name
 * @property int book_id
 */
class Author extends \Eloquent
{
    /**
     * No timestamps needed for this table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'book_id',
    ];
}
