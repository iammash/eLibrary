@extends('layouts.dashboard')

@section('pagetitle')
    Delete Book
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index') }}">Libraries</a></li>
        <li>
            <a href="{{ route('dashboard.libraries.view', ['library_id' => $library->id ] ) }}">{{ $library->name }}</a>
        </li>
        <li>
            <a href="{{ route('dashboard.libraries.books.index', ['library_id' => $library->id] ) }}">List of Books</a>
        </li>
        <li class="active">
            <a href="{{ route('dashboard.libraries.books.view', ['library_id' => $library->id, 'book_id' => $book->id] ) }}">
                <strong>Deletion of </strong> {{ $book->title }}
            </a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header box-danger with-border">
            <h3 class="box-title">Delete book "{{ $book->title }}"</h3>
        </div>
        <div class="box-body">
             <form action="{{ route('dashboard.libraries.books.request.remove', ['library_id', $library->id]) }}" method="POST">
                 {{csrf_field()}}
                 <input type="hidden" value="{{ $user->id }}" name="user_id">
                 <input type="hidden" value="{{ $book->id }}" name="book_id">
                 <input type="hidden" value="{{ $library->id }}" name="library_id">
                 <div class="form-group">
                     <div class="row">
                         <div class="col-sm-12">
                             <h3>This action can't be undone.</h3>
                             <p>Please confirm you want to delete this book</p>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                     <hr/>
                    <button type="submit" class="btn btn-danger" name="ebook_delete" value="1"><i class="fa fa-times"></i>
                        Confirm Deletion</button>
                 </div>
             </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
