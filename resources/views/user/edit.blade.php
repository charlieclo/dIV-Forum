@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Data</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('user/'.$user->id.'/update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                                
                                @if ($errors->has('phone'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                                
                                @if ($errors->has('address'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="dob" class="col-md-4 control-label">Birthday</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ $user->dob }}" required>
                                
                                @if ($errors->has('dob'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-4 text-right">Gender</label>

                            <div class="col-md-6">
                                @if ($user->gender == 'Male')
                                    <input id="genderMale" type="radio" class="radio-inline" name="gender" value="Male" checked> Male
                                    <input id="genderFemale" type="radio" class="radio-inline" name="gender" value="Female"> Female

                                @else
                                    <input id="genderMale" type="radio" class="radio-inline" name="gender" value="Male"> Male
                                    <input id="genderFemale" type="radio" class="radio-inline" name="gender" value="Female" checked> Female

                                @endif

                                @if ($errors->has('gender'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label">Photo</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="avatar" value="{{ $user->avatar }}">
                            
                                @if ($errors->has('avatar'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-4 text-right">Role</label>

                            <div class="col-md-6">
                                @if ($user->admin == 1)
                                    <input id="roleAdmin" type="radio"class="radio-inline" name="role" value="Admin" checked required> Admin
                                    <input id="roleMember" type="radio"class="radio-inline" name="role" value="Member" required> Member

                                @else
                                    <input id="roleAdmin" type="radio"class="radio-inline" name="role" value="Admin" required> Admin
                                    <input id="roleMember" type="radio"class="radio-inline" name="role" value="Member" checked required> Member
                                @endif

                                @if ($errors->has('role'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                   
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
