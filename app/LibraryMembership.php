<?php

namespace App;

/**
 *
 * Class Library
 * @package App
 *
 * @property int id
 * @property int user_id
 * @property int library_id
 * @property string access
 * @property string created_at
 * @property string updated_at
 */
class LibraryMembership extends \Eloquent
{
    /**
     * The table nbame for this model
     *
     * @var string
     */
    protected $table = 'user_library';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'library_id', 'access',
    ];
}
