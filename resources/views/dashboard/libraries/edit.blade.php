@extends('layouts.dashboard')

@section('pagetitle')
    Edit Library
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index') }}">Libraries</a></li>
        <li>
            <a href="{{ route('dashboard.libraries.view', ['library_id' => $library->id ] ) }}"> {{ $library->name }}</a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $library->name }}</h3>
        </div>
        <div class="box-body">
            @include('dashboard.libraries.forms.library', ['library' => $library, 'user' => $user ])
        </div>
        <!-- /.box-body -->
    </div>
@endsection
