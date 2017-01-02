<?php

namespace eLibrary;

/**
 *
 * Class Genre
 * @package App
 *
 * @property int id
 * @property string title
 */
class Genre extends \Eloquent
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
        'id', 'title',
    ];
}
