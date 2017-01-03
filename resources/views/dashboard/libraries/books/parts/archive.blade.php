

<table id="librarybooks" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Title</th>
        <th>Genre</th>
        <th>ISB</th>
        <th>Publish Date</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->genre_id }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->publish_date }}</td>
            <td width="80px">
                @if(isset($remove_controls) && !$remove_controls)
                <div class="dropdown">
                    <button class="btn btn-flat btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cogs"></i>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        @if( \eLibrary\Book::userCan('view', $user->id, $library->id, $book->id ) )
                            <li>
                                <a href="{{ route('dashboard.libraries.books.view', ['library_id' => $library->id, 'book_id' => $book->id]) }}">View</a>
                            </li>
                        @endif
                        @if(  \eLibrary\Book::userCan('edit', $user->id, $library->id, $book->id ) )
                            <li>
                                <a href="{{ route('dashboard.libraries.books.edit', ['library_id' => $library->id, 'book_id' => $book->id]) }}">Edit</a>
                            </li>
                        @endif
                        @if(  \eLibrary\Book::userCan('delete', $user->id, $library->id, $book->id ) )
                            <li>
                                <a class="text-red" href="{{ route('dashboard.libraries.books.delete', ['library_id' => $library->id, 'book_id' => $book->id]) }}">Delete</a>
                            </li>
                        @endif
                    </ul>
                </div>
                @else
                    @if( Auth::user()->hasMembershipAccessToBook( $book ) )
                        <a class="btn btn-success" href="{{ route('dashboard.libraries.books.view', ['library_id' => $book->library_id, 'book_id' => $book->id]) }}">
                            <i class="fa fa-eye"></i>
                            View Book
                        </a>
                    @elseif( Auth::user()->hasMembershipAccessToBookRequested( $book ) )
                        <form action="{{ route('dashboard.libraries.requestaccessfrombook') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button class="btn btn-warning" type="submit">Requested</button>
                        </form>

                    @else
                        <form action="{{ route('dashboard.libraries.requestaccessfrombook') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button class="btn btn-default" type="submit">Request Access</button>
                        </form>

                    @endif
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>