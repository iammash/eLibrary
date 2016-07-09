@extends('layouts.dashboard')

@section('pagetitle')
    Delete Book
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.books.index') }}">Books</a></li>
        <li class="active">Book Delete</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header box-danger with-border">
            <h3 class="box-title">Delete book "{{ $book->title }}"</h3>
        </div>
        <div class="box-body">
             <form action="{{ route('dashboard.books.request.remove') }}" method="POST">
                 {{csrf_field()}}
                 <input type="hidden" value="{{ $user->id }}" name="user_id">
                 <input type="hidden" value="{{ $book->id }}" name="book_id">
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
