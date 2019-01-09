@extends('layouts.app')

@section('content')
<!-- Container for Register Page -->
<div class="container">
    <!-- Reserve Row for Register Panel -->
    <div class="row">
         <!-- Set Column Size and Position for Register Panel -->
        <div class="col-md-8 col-md-offset-2">
            <!-- Register Panel -->
            <div class="panel panel-default">
                <!-- Register Panel Header -->
                <div class="panel-heading">Login</div>

                <!-- Register Panel Body -->
                <div class="panel-body">
                    <!-- Register Form -->
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        <!-- CSRF Field --> {{ csrf_field() }}

                        <!-- Form Group for E-Mail Address -->
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                <!-- Error Handler for E-Mail  Address -->
                                @if ($errors->has('email'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Form Group for Password -->
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <!-- Error Handler for Password -->
                                @if ($errors->has('password'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Form Group for Remember Me -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                               <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Login Button and Forgot Password Button -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password ?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
