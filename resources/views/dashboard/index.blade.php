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
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Users</span>
                    <span class="info-box-number">{{ $globaL_total_users_now }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    @endif

    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bolt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User Libraries Count</span>
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
                    <span class="info-box-text">User Libraries Storage</span>
                    <span class="info-box-number">{{ $user_libraries_size }}</span>
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
                    <span class="info-box-text">Total Files</span>
                    <span class="info-box-number">{{ $user_files_count }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Recently Added Libraries</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @foreach($user_recent_libraries as $library)
                        <li class="item">
                            <div class="product-img">
                                <i class="fa fa-file-pdf-o"></i>
                            </div>
                            <div class="product-info">
                                <h4 class="product-title">{{ $library->name }} <span class="label label-success pull-right">Quick Look</span></h4>
                                <span class="product-description">
                                  Added {{ \Carbon\Carbon::createFromTimeStamp(strtotime($library->created_at))->diffForHumans()  }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                        <!-- /.item -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
