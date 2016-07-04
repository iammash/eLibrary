@extends('layouts.dashboard')

@section('pagetitle')
    Welcome!
    <small>Howdy {{ $user->firstname }}?</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Books</span>
                    <span class="info-box-number">{{ $totalbooks }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Storage Used</span>
                    <span class="info-box-number">41,410</span>
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
                    <h3 class="box-title">Recently Added Books</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @foreach($recentbooks as $book)
                        <li class="item">
                            <div class="product-img">
                                <i class="fa fa-file-pdf-o"></i>
                            </div>
                            <div class="product-info">
                                <h4 class="product-title">{{$book->title}} <span class="label label-success pull-right">Quick Look</span></h4>
                                <span class="product-description">
                                  Added {{ \Carbon\Carbon::createFromTimeStamp(strtotime($book->created_at))->diffForHumans()  }}
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
