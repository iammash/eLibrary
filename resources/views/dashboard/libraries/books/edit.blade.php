@extends('layouts.dashboard')

@section('pagetitle')
    Edit Book
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
               <strong>Editing</strong> {{ $book->title }}
            </a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Editing book "{{ $book->title }}"</h3>
        </div>
        <div class="box-body">
            @include('dashboard.libraries.books.forms.upload', ['library' => $library, 'genres' => $genres, 'user_id' => $user->id, 'book' => $book])
        </div>
        <!-- /.box-body -->
    </div>
@endsection
