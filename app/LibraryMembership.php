<?php

namespace eLibrary;

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

    /**
     * If membership exists.
     *
     * @param $library_id
     * @param $user_id
     * @return bool
     */
    public static function membershipExists($library_id, $user_id)
    {
        $membership = static::where('library_id', '=', $library_id)->where('user_id', '=', $user_id);
        return ($membership != null && $membership->exists());
    }

    /**
     * @return mixed
     */
    public static function availableForMembership( $library_id ) {
        $ids = \DB::table('user_library')->where('library_id', '=', $library_id)->pluck('user_id');
        return \eLibrary\User::whereNotIn('id', $ids)->get();
    }
}
