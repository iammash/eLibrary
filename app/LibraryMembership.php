<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryMembership extends Model
{
    protected $table = 'user_library';

    protected $fillable = [
        'id', 'user_id', 'library_id', 'access',
    ];
}
