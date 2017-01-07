@extends('layouts.dashboard')

@section('pagetitle')
    View Library
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index') }}">Libraries</a></li>
        <li>
            <a href="{{ route('dashboard.libraries.view', ['library_id' => $library->id] ) }}"><strong>{{ $library->name }}</strong></a>
        </li>
    </ol>
@endsection

@section('content')

    <div class="row">

        <div class="col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-file-archive-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Books</span>
                    <span class="info-box-number">{{ $library->books()->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Members</span>
                    <span class="info-box-number">{{ $library->users()->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-light-blue"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Member Since</span>
                    <span class="info-box-number">{{ $member_since }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-sm-6">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-lock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Access</span>
                    <span class="info-box-number">{{ $access }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">About</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{ $library->description }}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="box-title">Books</h3>
                            </div>
                            @if(\eLibrary\Book::userCan('create', $library->id, $user->id))
                            <div class="col-sm-6">
                                <a class="pull-right link-black"
                                   href="{{ route('dashboard.libraries.books.add', ['library_id' => $library->id]) }}">
                                    <i class="fa fa-upload"></i>
                                    UPLOAD BOOK
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('dashboard.libraries.books.parts.archive', ['books' => $books->get(), 'library' => $library, 'user' => $user, 'remove_controls' => false])
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @if( \eLibrary\Library::userCan('everything', $user->id, $library->id))
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="box-title">Members</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('dashboard.libraries.parts.members', ['users' => $members])
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="box-title">Requests</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('dashboard.libraries.parts.requests', ['users' => $requests])
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @endif

@endsection


@section('footer')
@endsection