@extends('layouts.dashboard')

@section('pagetitle')
    View Library
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index') }}">Libraries</a></li>
        <li>
            <a href="{{ route('dashboard.libraries.new' ) }}"><strong>{{ $library->name }}</strong> Library</a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{$library->name}}</h3>
        </div>
        <div class="box-body">

        </div>
        <!-- /.box-body -->
    </div>
@endsection
