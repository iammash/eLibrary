<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryMembership extends Model
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
