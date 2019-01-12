@extends('layouts.app')

<!-- Page for Inputting Email to be Sent an Email including Reset Password Link -->
@section('content')
<!-- Container for Send Password Reset Link Page -->
<div class="container">
    <!-- Reserve Row for Send Password Reset Link Panel -->
    <div class="row">
        <!-- Set Column Size and Position for Send Password Reset Link Panel -->
        <div class="col-md-8 col-md-offset-2">
            <!-- Send Password Reset Link Panel -->
            <div class="panel panel-default">
                <!-- Send Password Reset Link Panel Header -->
                <div class="panel-heading">Reset Password</div>

                <!-- Send Password Reset Link Panel Body -->
                <div class="panel-body">
                    <!-- Alert if Email was Successfully Sent -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Send Password Reset Link Form -->
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        <!-- CSRF Field --> {{ csrf_field() }}

                        <!-- Form Group for E-Mail Address -->
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                <!-- Error Handler for E-Mail  Address -->
                                @if ($errors->has('email'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Send Password Reset Link Button -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
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
