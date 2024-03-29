@extends('layouts.app')

<!-- Page for User to Edit Profile -->
@section('content')
<!-- Container for Edit Profile -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Panel for Edit Profile -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading">User Data</div>

                <!-- Panel Body -->
                <div class="panel-body">
                    <!-- Edit Profile Form -->
                    <form class="form-horizontal" method="POST" action="{{ url('profile/'.$user->id.'/update') }}" enctype="multipart/form-data">
                        <!-- CSRF Field --> {{ csrf_field() }}
                        <!-- Method Field : PUT --> {{ method_field('PUT') }}
                        
                        <!-- Form Group for Name -->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

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
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                                
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
                                <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                                
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
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ $user->dob }}" required>
                                
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
                                <!-- Condition for User Gender is Male -->
                                @if ($user->gender == 'Male')
                                    <input id="genderMale" type="radio" class="radio-inline" name="gender" value="Male" checked> Male
                                    <input id="genderFemale" type="radio" class="radio-inline" name="gender" value="Female"> Female

                                @else
                                    <input id="genderMale" type="radio" class="radio-inline" name="gender" value="Male"> Male
                                    <input id="genderFemale" type="radio" class="radio-inline" name="gender" value="Female" checked> Female
                                @endif

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
                                <input type="file" class="form-control" name="avatar" value="{{ $user->avatar }}">
                                
                                <!-- Error Handler for Photo -->
                                @if ($errors->has('avatar'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                   
                        <!-- Profile Update Button -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
