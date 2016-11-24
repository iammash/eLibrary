@extends('layouts.auth')

@section('head')
    <title>eLibrary Login</title>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-box">
            <div class="form-top">
                <div class="form-top-left">
                    <h3>Login to our site</h3>
                    <p>Enter your username and password to log on:</p>
                </div>
                <div class="form-top-right">
                    <i class="fa fa-key"></i>
                </div>
            </div>
            <div class="form-bottom">

                <form role="form" method="POST" action="{{ url('/login') }}">

                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="sr-only" for="form-username">E-mail</label>
                        <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="sr-only" for="form-password">Password</label>
                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn">Sign in!</button>
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </form>
            </div>
        </div>
    </div>
@endsection
