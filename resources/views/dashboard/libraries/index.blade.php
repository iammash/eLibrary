@extends('layouts.dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/resources/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('pagetitle')
    List
    <small>Showing all user's libraries</small>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('dashboard.libraries.index') }}">Libraries</a></li>
        <li class="active">List</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header two-cols">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="box-title">
                                My Libraries
                            </h3>
                        </div>
                        <div class="col-sm-6">
                            <form class="form-inline pull-right">
                                <input type="text" class="form-control" placeholder="eg. Computer science">
                                <button class="btn btn-default" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('dashboard.libraries.parts.archive', ['libraries' => $libraries->get()])
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/resources/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/resources/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        (function ( $ ) {

        })(jQuery)
    </script>
@endsection
