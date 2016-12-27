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
                        <h3 class="box-title">Books</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="librarybooks" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Genre</th>
                                <th>ISB</th>
                                <th>Publish Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books->get() as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->genre()->first()->title }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ $book->publish_date }}</td>
                                    <td width="80px">
                                        <a href="" class="btn  btn-success"><i class="fa fa-eye-slash"></i> read</a>
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
    </div>

@endsection


@section('footer')
    <script src="{{ asset('assets/resources/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/resources/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#librarybooks').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endsection