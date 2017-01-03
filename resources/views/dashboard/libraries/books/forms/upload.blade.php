@if( isset( $book ) )
    <?php
    $btn               = 'Save';
    $library_id        = $library->id;
    $book_id           = $book->id;
    $book_title        = $book->title;
    $book_description  = $book->description;
    $book_isbn         = $book->isbn;
    $book_publisher    = $book->publisher;
    $book_publish_date = $book->publish_date;
    $book_genre        = $book->genre_id;
    $route_name        = route('dashboard.libraries.books.update', ['library_id' => $library->id, 'book_id' => $book_id ]);
    ?>
@else
    <?php
    $btn               = 'Upload';
    $library_id        = $library->id;
    $book_title        = old('book_title');
    $book_description  = old('book_description');
    $book_isbn         = old('book_isbn');
    $book_publisher    = old('book_publisher');
    $book_publish_date = old('book_publish_date');
    $book_genre        = old('book_genre');
    $route_name        = route('dashboard.libraries.books.create');
    ?>
@endif

<form class="upload-file" method="post" action="{{ $route_name }}" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="{{ $user_id }}">
    @if(isset($library_id))
        <input type="hidden" name="library_id" value="{{ $library_id }}">
    @endif
    @if(isset($book_id))
        <input type="hidden" name="book_id" value="{{ $book_id }}">
    @endif
    {{csrf_field()}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label for="book_title" class="pull-right">Title</label>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                <input class="form-control" type="text" name="book_title" id="book_title" value="{{ $book_title }}" placeholder="Enter Book Title" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label for="book_description" class="pull-right">Description</label>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                <textarea class="form-control" name="book_description" id="book_description" >{{ $book_description }}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label class="pull-right">Book Meta Data</label>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                <input class="form-control" type="text" name="book_isbn" id="book_isbn" value="{{ $book_isbn }}"
                       placeholder="Enter Book ISBN" />
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                <input class="form-control" type="text" name="book_publisher" id="book_publisher" value="{{ $book_publisher }}"
                       placeholder="Enter Book Publisher name" />
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                <input class="form-control" type="text" name="book_publish_date" id="book_publish_date" value="{{ $book_publish_date }}"
                       placeholder="Enter Book Publish Date" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label for="book_genre" class="pull-right">Genre</label>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                <select name="book_genre" id="book_genre" class="form-control">
                    <option disabled selected>Select Genre</option>
                    @foreach($genres as $genre)
                        <option {{ ($book_genre==$genre->id) ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        @if( ! isset( $book ) )
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                <label for="book_file" class="pull-right">Upload</label>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                <input type="file" id="book_file" name="book_file" class="inputfile">
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                    <label for="book_file" class="pull-right">View</label>
                </div>
                <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12">
                    <a class="btn btn-info" href="{{ route('dashboard.libraries.books.view', ['library_id' => $library->id, 'book_id' => $book->id]) }}">View Book</a>
                </div>
            </div>

        @endif
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                <hr/>
                <button id="submitEbook" class="btn btn-primary pull-right"><i class="fa fa-arrow-up"></i> {{ $btn }}</button>
            </div>
        </div>
    </div>
</form>