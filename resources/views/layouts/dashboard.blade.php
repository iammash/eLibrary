<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eLibrary</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('assets/resources/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/AdminLTE.min.css') }} ">
    <!-- App Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/css/skins/skin-green-light.css') }} ">

    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/resources/select2/css/select2.min.css') }}" />

    <!-- Custom stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }} ">

    @yield('head')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
<body class="hold-transition skin-green-light layout sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('dashboard.index') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>e</b>Lib</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>e</b>Library</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('assets/images/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->firstname }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('assets/images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                <p>
                                    {{ Auth::user()->firstname }}
                                    <small>Member since {{ Auth::user()->created_at }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('dashboard.profile') }}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-danger btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('assets/images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->firstname }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li {!! (\Route::is('dashboard.index') ? 'class="active"' : '') !!}>
                    <a href="{{ route("dashboard.index") }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview {!! (\Route::is('dashboard.libraries.*') ? 'active' : '') !!}">
                    <a href="#">
                        <i class="fa fa-paperclip"></i> <span>Libraries</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{!! (\Route::is('dashboard.libraries.index') ? 'active' : '') !!}">
                            <a href="{{ route('dashboard.libraries.index') }}"><i class="fa fa-circle-o"></i> List Libraries</a>
                        </li>
                    </ul>
                </li>
                <li class="header">OTHER</li>
                <li {!! (\Route::is('dashboard.settings') ? 'class="active"' : '') !!}><a href="#"><i class="fa fa-circle-o text-red"></i>
                        <span>Settings</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('pagetitle')
            </h1>
                @yield('breadcrumbs')
        </section>

        <!-- Main content -->
        <section class="content">
            @if(\Session::has('form_response') || count( $errors->all() ) > 0)
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                    <?php $object = json_decode(\Session::get('form_response')); ?>
                    @if( (isset( $object->type ) && isset( $object->message )) )
                        <div class="alert alert-{{ $object->type }}">
                            <h5>
                                @if($object->type == 'danger')
                                    <strong>Error!</strong>
                                @else
                                    <strong>{{ ucfirst( $object->type ) }}!</strong>
                                @endif
                                {{ $object->message }}
                            </h5>
                            @if(isset( $object->list ) && count( $object->list ) > 0 )
                                <ul class="errors">
                                    @foreach($object->list as $o)
                                        <li>{{$o}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <h5><strong>Error!</strong> Please correct the following errors:</h5>
                            <ul class="errors">
                                @foreach($errors->all() as $o)
                                    <li>{{$o}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            @endif
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} <a href="http://darkog.com">eLibrary</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="{{ asset('assets/resources/jQuery/jQuery-2.2.0.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/resources/iCheck/icheck.min.js') }}"></script>
<!-- Genral js -->
<script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/resources/bootstrap/js/bootstrap.min.js') }}" ></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/resources/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<!-- Select 2 -->
<script src="{{ asset('assets/resources/select2/js/select2.js') }}"></script>

@yield('footer')

<script>
(function($){
    $('select').select2();
})(jQuery);
</script>

</body>
</html>
