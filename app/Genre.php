<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * Class Genre
 * @package App
 *
 * @property int id
 * @property string title
 */
class Genre extends Model
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
