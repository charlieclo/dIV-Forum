@extends('layouts.app')
<style>
    .profile-image {
        width: 200px;
        height: 200px;
    }

    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th {
        border: none !important;
    }
</style>

<!-- Page for User's or Admin's Profile based on Registry Data -->
@section('content')
<!-- Container for Profile Index -->
<div class="container">
    <div class="row">
        <!-- Panel for Viewing Profile -->
        <div class="panel panel-default">
            <!-- Panel Body -->
            <div class="panel-body">
                <div class="row">
                    <!-- User Photo -->
                    <div class="col-md-2 col-md-offset-1 text-center">
                        <img src="/avatars/{{ $user->avatar }}" class="profile-image">
                    </div>

                    <div class="col-md-5 col-md-offset-1">
                        <!-- Profile Table -->
                        <table class="table table-borderless">
                            <!-- Table Body -->
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>

                                <tr>
                                    <th>Popularity</th>
                                    <td>
                                        <!-- Good Vote Button -->
                                        <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> {{ $user->good_vote }}</button>
                                        <!-- Bad Vote Button -->
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i> {{ $user->bad_vote }}</button>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>

                                <tr>
                                    <th>Birthday</th>    
                                    <td>{{ $user->dob }}</td>
                                </tr>

                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $user->gender }}</td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>{{ $user->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Condition for Aunthenticated User -->
                    @auth
                        <!-- Condition for Authenticated User ID is same like User's ID that will be Shown --> 
                        @if(Auth::user()->id == $user->id)
                            <div class="col-md-2 text-right">
                                <!-- Edit Profile Button -->
                                <a href="{{ url('profile/'.$user->id.'/edit') }}"><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button></a>
                            </div> 

                        @else
                            <div class="col-md-2 text-center">
                                <!-- Panel for Give Popularity -->
                                <div class="panel panel-default">
                                    <!-- Panel Header -->
                                    <div class="panel-heading">Give Popularity</div>
                                       
                                    <!-- Panel Body -->
                                    <div class="panel-body">
                                        <!-- Condition for Good Vote has Occured and Vote Sender is Authenticated User's ID and Vote Receiver is User's ID that profile was Shown -->
                                        @if($voter != null && $voter->vote_sender == Auth::user()->id && $voter->vote_receiver == $user->id && $voter->status == 1)
                                            <!-- Good Vote Pressed Button -->
                                            <a href="{{ url('vote/'.Auth::user()->id.'/'.$user->id.'/1') }}"><button type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i></button></a>
                                        
                                        @else
                                            <!-- Good Vote Unpressed Button -->
                                            <a href="{{ url('vote/'.Auth::user()->id.'/'.$user->id.'/1') }}"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>
                                        @endif

                                        <!-- Condition for Bad Vote has Occured and Vote Sender is Authenticated User's ID and Vote Receiver is User's ID that profile was Shown -->
                                        @if($voter != null && $voter->vote_sender == Auth::user()->id && $voter->vote_receiver == $user->id && $voter->status == 0)
                                            <!-- Bad Vote Pressed Button -->
                                            <a href="{{ url('vote/'.Auth::user()->id.'/'.$user->id.'/0') }}"><button type="button" class="btn btn-outline-danger"><i class="fas fa-minus"></i></button></a>
                                        
                                        @else
                                            <!-- Bad Vote Unpressed Button -->
                                            <a href="{{ url('vote/'.Auth::user()->id.'/'.$user->id.'/0') }}"><button type="button" class="btn btn-danger"><i class="fas fa-minus"></i></button></a>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <!-- Condition for Aunthenticated User -->
        @auth
            <!-- Condition for Authenticated User ID is same like User;s ID that will be Shown -->
            @if(Auth::user()->id != $user->id)
                <!-- Panel for Message -->
                <div class="panel panel-default">
                    <!-- Panel Header -->
                    <div class="panel-heading">Message</div>
                    
                    <!-- Panel Body -->
                    <div class="panel-body">
                        <!-- Message Form -->
                        <form class="form-horizontal" method="POST" action="{{ url('message/'.$user->id) }}" enctype="multipart/form-data">
                            <!-- CSRF Field --> {{ csrf_field() }}
                        
                            <!-- Form Group for Message Content -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea type="text" name="content" class="form-control" required></textarea>
                                    
                                    <!-- Error Handler for Message Content -->
                                    @if ($errors->has('content'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Send Message Button -->
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fab fa-telegram-plane"></i> Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection