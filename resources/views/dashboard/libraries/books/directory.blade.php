@extends('layouts.dashboard')

@section('pagetitle')
    Books
    <small>Listing books</small>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('dashboard.books' ) }}">Books</a></li>
    </ol>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Books</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('dashboard.libraries.books.parts.archive', ['books' => $books, 'remove_controls' => true])

                    {{ $books->render() }}

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection
