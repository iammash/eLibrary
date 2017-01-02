<?php

namespace eLibrary;

use Illuminate\Filesystem\Filesystem;
use Storage;
use File;
use DB;

/**
 *
 * Class Book
 * @package App
 *
 * @property int id
 * @property string title
 * @property int genre_id
 * @property string cover_image
 * @property string isbn
 * @property string publish_date
 * @property string publisher
 * @property string file
 * @property string description
 * @property int library_id
 * @property int user_id
 * @property int file_size
 * @property string created_at
 * @property string updated_at
 */
class Book extends \Eloquent
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
        return $this->hasMany('eLibrary\Author');
    }

    /**
     * Get the genre record associated with the user.
     */
    public function genre()
    {
        return $this->belongsTo('eLibrary\Genre');
    }

    /**
     * Get the library that this book is associated with.
     */
    public function library()
    {
        return $this->belongsTo('eLibrary\Library');
    }

    /**
     * Get the user that uploaded this book
     */
    public function user()
    {
        return $this->belongsTo('eLibrary\User');
    }

    /**
     * Store a book file to the user directory
     * @param $fromPath
     * @param int $copyOrMove
     * @return bool
     */
    public function storeBookFile($fromPath, $copyOrMove = 0)
    {
        $toPath = self::getBookPath($this->user_id, $this->file);

        //check if the user directory exists before storing, if not create it.
        if (!File::isDirectory(self::getUserDirectory($this->user_id))) {
            File::makeDirectory(self::getUserDirectory($this->user_id));
        }

        //if same file already exists
        if (File::exists($toPath)) {
            return false;
        }

        if ($copyOrMove === self::FILE_COPY) {
            return File::copy($fromPath, $toPath);
        }

        return File::move($fromPath, $toPath);
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
        if (null === $isDeleted || true === $isDeleted) {
            File::delete(self::getBookPath($this->user_id, $this->file));
        }
        return $isDeleted;
    }

    /**
     * Returns The book size
     *
     * @param int $pretty_format
     * @param bool $from_db
     * @return int|mixed|string
     */
    public function getBookFileSize($pretty_format = 0, $from_db = true)
    {

        if (true === $from_db) {
            $size = $this->file_size;
        } else {
            $bookPath = self::getBookPath($this->user_id, $this->file);
            $size = File::size($bookPath);
        }

        if (!is_numeric($size)) {
            return 0;
        }

        if ($pretty_format === self::FILESIZE_PRETTY_FORMAT) {
            return formatBytes($size, $pretty_format);
        }
        return $size;
    }


    /**
     * Return the user directory private path
     * @param $userID integer
     * @return string
     */
    public static function getUserDirectory($userID)
    {
        return storage_path('app/private') . '/' . (string)$userID . '/';
    }

    /**
     * Return the user file private path
     * @param $userID
     * @param $fileName
     * @return string
     */
    public static function getBookPath($userID, $fileName)
    {
        return self::getUserDirectory($userID) . $fileName;
    }


    /**
     * Generate new unique file name for the book
     *
     * @param $extension
     * @return string
     */
    public static function generateFileName($extension)
    {
        $random = str_random(10) . '.' . $extension;
        $exists = self::where('file', '=', $random)->count();
        if ($exists > 0) {
            return self::generateFileName($extension);
        }
        return $random;
    }


    /**
     * Creates new model into the database
     *
     * @param $bookFilePath
     * @param array $attributes
     * @param int $move
     * @return bool|Book
     */
    public static function createBook($bookFilePath, array $attributes = [], $move = 0)
    {
        if (!isset($attributes['file'])) {
            $attributes['file'] = self::generateFileName('pdf');
        }

        if (!File::exists($bookFilePath)) {
            return false;
        }

        $attributes['file_size'] = File::size($bookFilePath);

        $book = self::create($attributes);

        if ($book) {
            $book->storeBookFile($bookFilePath, $move);
            return $book;
        }
        return false;
    }


    /**
     * Control access of the library
     *
     * @param $doWhat
     * @param $user_id
     * @param $library_id
     * @param null $book_id
     * @return bool
     */
    public static function userCan($doWhat, $user_id, $library_id, $book_id = null)
    {
        if ($doWhat !== 'create' && $book_id === null) {
            return false;
        }

        $query = DB::table('user_library')->select('*')
            ->join('books', 'user_library.user_id', '=', 'books.user_id')
            ->where('user_library.user_id', '=', $user_id)
            ->where('user_library.library_id', '=', $library_id);

        if ($book_id !== null) {
            $query->where('books.id', '=', $book_id);
        }

        if (!$query->exists()) {
            return false;
        }

        if ($doWhat === 'view') {
            return $query->where('user_library.access', '=', Library::ACCESS_READ)
                ->orWhere('user_library.access', '=', Library::ACCESS_WRITE)
                ->orWhere('user_library.access', '=', Library::ACCESS_DELETE)
                ->orWhere('user_library.access', '=', Library::ACCESS_MANAGER)
                ->orWhere('user_library.access', '=', Library::ACCESS_OWNER)
                ->exists();
        }

        if ($doWhat === 'edit') {
            return $query->where('user_library.access', '=', Library::ACCESS_WRITE)
                ->orWhere('user_library.access', '=', Library::ACCESS_DELETE)
                ->orWhere('user_library.access', '=', Library::ACCESS_MANAGER)
                ->orWhere('user_library.access', '=', Library::ACCESS_OWNER)
                ->exists();
        }

        if ($doWhat === 'delete') {
            return $query->where('user_library.access', '=', Library::ACCESS_DELETE)
                ->orWhere('user_library.access', '=', Library::ACCESS_MANAGER)
                ->orWhere('user_library.access', '=', Library::ACCESS_OWNER)
                ->exists();
        }

        if ($doWhat === 'create') {
            return $query->where('user_library.access', '=', Library::ACCESS_WRITE)
                ->orWhere('user_library.access', '=', Library::ACCESS_DELETE)
                ->orWhere('user_library.access', '=', Library::ACCESS_MANAGER)
                ->orWhere('user_library.access', '=', Library::ACCESS_OWNER)
                ->exists();
        }

        return false;
    }

}
