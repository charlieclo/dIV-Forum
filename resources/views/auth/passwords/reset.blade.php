@extends('layouts.app')

<!-- Page for Resetting Password based on Email Token -->
@section('content')
<!-- Container for Password Reset Page -->
<div class="container">
    <!-- Reserve Row for Password Reset Panel -->
    <div class="row">
        <!-- Set Column Size and Position for Password Reset Panel -->
        <div class="col-md-8 col-md-offset-2">
            <!-- Password Reset Panel -->
            <div class="panel panel-default">
                <!-- Password Reset Panel Header -->
                <div class="panel-heading">Reset Password</div>

                <!-- Password Reset Panel Body -->
                <div class="panel-body">
                    <!-- Password Reset Form -->
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        <!-- CSRF Field --> {{ csrf_field() }}

                        <!-- Hidden Token -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Form Group for E-Mail Address -->
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                <!-- Error Handler for E-Mail Address -->
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

                        <!-- Form Group for Password Confirmation -->
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Password Reset Button -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
