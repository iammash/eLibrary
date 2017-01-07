

@extends('layouts.dashboard')

@section('pagetitle')
 Users
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>
            <a href="{{ route('dashboard.users')}}"><strong>Users</strong></a>
        </li>
    </ol>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User list</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('dashboard.users.parts.table', ['user' => $user, 'users' => $users])
                </div>
            </div>
        </div>
    </div>

@endsection


@section('footer')

@endsection