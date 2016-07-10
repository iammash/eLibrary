@extends('layouts.dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/resources/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('pagetitle')
    Books
    <small>Showing all user's books</small>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index') }}">Libraries</a></li>
        <li><a href="{{ route('dashboard.libraries.view', ['library_id' => $library->id ] ) }}">{{ $library->name }}</a></li>
        <li class="active"><a href="{{ route('dashboard.libraries.books.index', ['library_id' => $library->id] ) }}">List of Books</a></li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">

    </div>
    <div class="col-sm-6">
        <a class="btn btn-primary pull-right with-margin-top-bottom"><i class="fa fa-plus"></i> Create New</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">My Books</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="booksTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-center">Genre</th>
                        <th class="text-center">Uploaded</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{$book->title}}</td>
                        <td class="text-center">{{$book->genre()->getResults()->title}}</td>
                        <td class="text-center">{{$book->created_at}}</td>
                        <td class="text-center" width="10%">
                            <div class="dropdown">
                                <button class="btn btn-flat btn-info dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cogs"></i>
                                <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @if( App\Book::userCan('view', $user->id, $library->id, $book->id ) )
                                    <li>
                                        <a href="{{ route('dashboard.libraries.books.view', ['library_id' => $library->id, 'book_id' => $book->id]) }}">View</a>
                                    </li>
                                    @endif
                                    @if( App\Book::userCan('edit', $user->id, $library->id, $book->id ) )
                                    <li>
                                        <a href="{{ route('dashboard.libraries.books.edit', ['library_id' => $library->id, 'book_id' => $book->id]) }}">Edit</a>
                                    </li>
                                     @endif
                                     @if( App\Book::userCan('delete', $user->id, $library->id, $book->id ) )
                                    <li>
                                        <a class="text-red" href="{{ route('dashboard.libraries.books.delete', ['library_id' => $library->id, 'book_id' => $book->id]) }}">Delete</a>
                                    </li>
                                     @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Title</th>
                        <th class="text-center">Genre</th>
                        <th class="text-center">Uploaded</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection

@section('footer')
    <script src="{{ asset('assets/resources/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/resources/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        (function ( $ ) {
            $('#booksTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "aoColumns": [
                    null,
                    null,
                    null,
                    { "bSortable": false }
                ]
            });
        })(jQuery)
    </script>
@endsection
