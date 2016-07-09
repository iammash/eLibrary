@extends('layouts.dashboard')

@section('pagetitle')
    Edit Book
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.books.index') }}">Books</a></li>
        <li class="active">Book Edit</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Editing book "{{ $book->title }}"</h3>
        </div>
        <div class="box-body">
            @include('dashboard.books.forms.upload', ['genres' => $genres, 'user_id' => $user->id, 'book' => $book])
        </div>
        <!-- /.box-body -->
    </div>
@endsection
