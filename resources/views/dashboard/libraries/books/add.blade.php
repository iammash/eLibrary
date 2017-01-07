@extends('layouts.dashboard')

@section('pagetitle')
    Add New Book
    <small>Upload Book</small>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index', ['library_id' => $library->id]) }}">{{ $library->name }}</a></li>
        <li class="active">Book Add</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Upload new eBook</h3>
        </div>
        <div class="box-body">
            @include('dashboard.libraries.books.forms.upload', ['library' => $library, 'genres' => $genres, 'user_id' => $user->id])
        </div>
    </div>
@endsection