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
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            <a class="btn btn-primary pull-right with-margin-top-bottom"><i class="fa fa-plus"></i> Create New</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">My Libraries</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="librariesTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Created</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($libraries->get() as $library)
                            <tr>
                                <td>{{ $library->name }}</td>
                                <td class="text-center">{{ $library->description }}</td>
                                <td class="text-center">{{ $library->created_at }}</td>
                                <td class="text-center" width="10%">
                                    <div class="dropdown">
                                        <button class="btn btn-flat btn-info dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cogs"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('dashboard.libraries.view', ['library_id' => $library->id]) }}">View Books</a></li>
                                            <li><a href="{{ route('dashboard.libraries.edit', ['library_id' => $library->id]) }}">Manage</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
            $('#librariesTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "aoColumns": [
                    null,
                    null,
                    null,
                    { "bSortable": false }
                ]
            });
        })(jQuery)
    </script>
@endsection
