@extends('layouts.dashboard')

@section('pagetitle')
    Create Library
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index') }}">Libraries</a></li>
        <li>
            <a href="{{ route('dashboard.libraries.new' ) }}"><strong>Create</strong> Library</a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create library</h3>
        </div>
        <div class="box-body">
            @include('dashboard.libraries.parts.settings', ['user' => $user ])
        </div>
        <!-- /.box-body -->
    </div>
@endsection
