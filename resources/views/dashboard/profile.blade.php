

@extends('layouts.dashboard')

@section('pagetitle')
   Profile Settings
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>
            <a href="{{ route('dashboard.profile')}}"><strong>Profile</strong></a>
        </li>
    </ol>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">My Profile</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{route('dashboard.profile.save')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="first_name" class="col-sm-2 control-label">First Name</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="first_name" name="first_name" value="{{ $user->firstname }}" placeholder="First Name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">Last Name</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="last_name" name="last_name" value="{{ $user->lastname }}" placeholder="Last Name" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input class="form-control" id="email" value="{{ $user->email }}" placeholder="email" disabled type="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="current_password" class="col-sm-2 control-label">Current Password</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="current_password" id="current_password" placeholder="Current Password" type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="col-sm-2 control-label">New Password</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="new_password" id="new_password" placeholder="New Password" type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirm" class="col-sm-2 control-label">Confirm New Password</label>

                            <div class="col-sm-10">
                                <input class="form-control" name="new_password_confirm" id="new_password_confirm" value="" placeholder="New Password Confirmation" type="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('footer')

@endsection