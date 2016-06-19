<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 * @package App
 */
class Author extends Model
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
