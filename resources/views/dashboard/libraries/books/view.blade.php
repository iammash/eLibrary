@extends('layouts.dashboard')

@section('pagetitle')
    Showing Book
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
            <a href="{{ route('dashboard.libraries.books.view', ['library_id' => $library->id, 'book_id' => $book->id] ) }}">{{ $book->title }}</a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Read eBook</h3>
        </div>
        <div class="box-body">
            <iframe width="100%" height="800px"
                    src="{{ route('user_files.show', ['user_id' => $book->user()->first()->id, 'file_name' => $book->file ]) }}"></iframe>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <span class="pull-left">
                Uploaded by <strong>{{ $book->user()->first()->firstname }}</strong>
            </span>
            <span class="pull-right">
                Uploaded on <strong>{{  Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $book->created_at )->format('Y-m-d') }}</strong>
            </span>
        </div>
        <!-- /.box-footer-->
    </div>
@endsection

@section('script')

@endsection