@extends('layouts.dashboard')

@section('pagetitle')
    Search "{{ $q }}"
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>
            <strong>Search "{{ $q }}"</strong>
        </li>
    </ol>
@endsection

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Libraries
                    </h3>
                </div>
                <div class="box-body">
                    @if($libraries->count())
                        @include('dashboard.libraries.parts.archive', ['libraries' => $libraries])
                        @if($libraries->hasMorePages())
                            {{ $libraries->render() }}
                        @endif
                    @else
                        <p>No libraries found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        Books
                    </h3>
                </div>
                <div class="box-body">
                    @if($libraries->count())
                        @include('dashboard.libraries.books.parts.archive', ['books' => $books])
                        @if($libraries->hasMorePages())
                            {{ $libraries->render() }}
                        @endif
                    @else
                        <p>No books found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')

@endsection