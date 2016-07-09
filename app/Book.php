<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Filesystem\Filesystem;
use Storage;
use File;
use Auth;

/**
 * Class Book
 * @package App
 */
class Book extends Model
{
    /**
     * Constant used to determine the file should be moved or copied
     */
    const FILE_COPY = 1;

    /**
     * Constant used to determine the file should be moved or copied
     */
    const FILE_MOVE = 0;

    /**
     * Constant used to determine if file size is printed in pretty format
     */
    const FILESIZE_PRETTY_FORMAT = 1;

    /**
     * The books file system
     * @var Filesystem
     */
    private $filesystem = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'genre_id', 'cover_image', 'isbn', 'publisher', 'file', 'publish_date', 'description', 'user_id',
    ];

    /**
     * Book constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->filesystem = Storage::disk('private');
    }

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

    /**
     * Store a book file to the user directory
     * @param $fromPath
     * @param int $copyOrMove
     * @return bool|void
     */
    public function storeBookFile( $fromPath, $copyOrMove = 0 )
    {
        $toPath = self::getBookPath( $this->user_id, $this->file );

        //check if the user directory exists before storing, if not create it.
        if( ! File::isDirectory( self::getUserDirectory( $this->user_id ) ) ){
            File::makeDirectory( self::getUserDirectory( $this->user_id ) );
        }

        //if same file already exists
        if( File::exists( $toPath ) ) {
            return false;
        }

        if( $copyOrMove === self::FILE_COPY ) {
            return File::copy( $fromPath,  $toPath );
        }

        return File::move( $fromPath,  $toPath );
    }


    /**
     * Overload the method to remove the book - completely with its files.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        $isDeleted = parent::delete();
        if( null === $isDeleted || true === $isDeleted )
        {
            File::delete( self::getBookPath( $this->user_id, $this->file ) );
        }
        return $isDeleted;
    }

    /**
     * Returns The book size
     * @return int
     */
    public function getBookFileSize( $pretty_format = 0 )
    {
        $bookPath = self::getBookPath( $this->user_id, $this->file );
        $size = File::size( $bookPath );

        if( $pretty_format === self::FILESIZE_PRETTY_FORMAT ){

            $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

            for ($i = 0; $size > 1024; $i++) {
                $size /= 1024;
            }

            return round($size, 2) . ' ' . $units[$i];
        }

        return $size;
    }


    /**
     * Return the user directory private path
     * @param $userID integer
     * @return string
     */
    public static function getUserDirectory( $userID )
    {
        return storage_path('app/private') . '/' . (string)$userID . '/';
    }

    /**
     * Return the user file private path
     * @param $userID
     * @param $fileName
     * @return string
     */
    public static function getBookPath( $userID, $fileName )
    {
        return self::getUserDirectory( $userID ) . $fileName;
    }


    /**
     * Generate new unique file name for the book
     *
     * @param $extension
     * @return string
     */
    public static function generateFileName( $extension )
    {
        $random = str_random(10).'.'.$extension;
        $exists = self::where('file', '=', $random)->count();
        if( $exists > 0 ){
            return self::generateFileName( $extension );
        }
        return $random;
    }



    /**
     * Creates new model into the database
     * 
     * @param $bookFilePath
     * @param array $attributes
     * @param int $move
     * @return bool|static
     */
    public static function createBook($bookFilePath, array $attributes = [], $move = 0)
    {
        if(!isset($attributes['file'])){
            $attributes['file'] = self::generateFileName('pdf');
        }

        if(!File::exists($bookFilePath)){
            return false;
        }

        $book = self::create($attributes);

        if( $book ) {
            $book->storeBookFile( $bookFilePath, $move );
            return $book;
        }
        return false;
    }

}
