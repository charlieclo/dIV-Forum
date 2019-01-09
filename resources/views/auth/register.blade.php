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
                <div class="panel-heading">Register</div>

                <!-- Register Panel Body -->
                <div class="panel-body">
                    <!-- Register Form -->
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        <!-- CSRF Field --> {{ csrf_field() }}

                        <!-- Form Group for Name -->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                <!-- Error Handler for Name -->
                                @if ($errors->has('name'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Form Group for Phone Number -->
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" required>
                                
                                <!-- Error Handler for Phone Number -->
                                @if ($errors->has('phone'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Form Group for Address -->
                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" required>
                                
                                <!-- Error Handler for Address -->
                                @if ($errors->has('address'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <!-- Form Group for Date of Birthday -->
                        <div class="form-group">
                            <label for="dob" class="col-md-4 control-label">Birthday</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" required>
                                
                                <!-- Error Handler for Date of Birthday -->
                                @if ($errors->has('dob'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <!-- Form Group for Gender -->
                        <div class="form-group">
                            <label for="gender" class="col-md-4 text-right">Gender</label>

                            <div class="col-md-6">
                                <input id="genderMale" type="radio" class="radio-inline" name="gender" value="Male" required> Male
                                <input id="genderFemale" type="radio" class="radio-inline" name="gender" value="Female" required> Female

                                <!-- Error Handler for Gender -->
                                @if ($errors->has('gender'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <!-- Form Group for Photo -->
                        <div class="form-group">
                                <label for="avatar" class="col-md-4 control-label">Photo</label>
    
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="avatar">
                                    
                                    <!-- Error Handler for Photo -->
                                    @if ($errors->has('avatar'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <!-- Form Group for Agreement -->
                        <div class="form-group">
                            <label for="agree" class="col-md-4 control-label"><input id="agree" type="checkbox" class="checkbox-inline" name="agree" value="agree" required></label>

                            <div class="col-md-6">
                                By registering to this website, I agree term and condition
                            </div>

                            <!-- Error Handler for Agreement -->
                            @if ($errors->has('agree'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('agree') }}</strong>
                                </span>
                            @endif
                        </div>

                        <!-- Register Button -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
