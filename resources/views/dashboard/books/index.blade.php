@extends('layouts.dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/resources/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('pagetitle')
    Books
    <small>Showing all user's books</small>
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
                        <td class="text-center">
                            <a href="{{ route('dashboard.books.view', ['book_id' => $book->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
                            <a href="{{ route('dashboard.books.edit', ['book_id' => $book->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a href="{{ route('dashboard.books.delete', ['book_id' => $book->id]) }}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</a>
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
