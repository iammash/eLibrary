@extends('layouts.dashboard')

@section('pagetitle')
    Welcome!
    <small>Howdy {{ $user->firstname }}?</small>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="active"><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
@endsection

@section('content')
    @if( $user->isAdmin() )
        <div class="row">
            <div class="col-sm-12">
                <h4>Administration</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">System Total Active Users</span>
                        <span class="info-box-number">{{ $globaL_total_users_now }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-book" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">System Total Books Count</span>
                        <span class="info-box-number">{{ $global_files_count }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-paperclip" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">System Total Libraries Count</span>
                        <span class="info-box-number">{{ $global_total_libraries }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h4>User Perks</h4>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-paperclip" aria-hidden="true"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">My Libraries Count</span>
                    <span class="info-box-number">{{ $user_total_libraries }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-cloud"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">My Libraries Storage</span>
                    <span class="info-box-number">{{ !empty($user_libraries_size) ? $user_libraries_size : '0 Bytes' }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-file-archive-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">My Books</span>
                    <span class="info-box-number">{{ $user_files_count }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

@endsection
