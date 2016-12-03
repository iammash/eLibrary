

@extends('layouts.dashboard')

@section('pagetitle')
    Settings
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>
            <a href="{{ route('dashboard.settings')}}"><strong>Settings</strong></a>
        </li>
    </ol>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">

        </div>
    </div>

@endsection


@section('footer')

@endsection