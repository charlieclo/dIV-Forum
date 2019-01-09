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

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2 col-md-offset-1 text-center">
                        <img src="/avatars/{{ $user->avatar }}" class="profile-image">
                    </div>

                    <div class="col-md-5 col-md-offset-1">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>

                                <tr>
                                    <th>Popularity</th>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> {{ $user->plus_popularity }}</button>
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i> {{ $user->minus_popularity }}</button>
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

                    @auth
                        @if(Auth::user()->id == $user->id)
                            <div class="col-md-2 text-right">
                                <a href="{{ url('user/'.$user->id.'/editprofile') }}"><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button></a>
                            </div> 

                        @else
                            <div class="col-md-2 text-center">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Give Popularity</div>
                                       
                                    <div class="panel-body">
                                        @if($voter_relationship != null && $voter_relationship->vote_giver == Auth::user()->id && 
                                            $voter_relationship->vote_receiver == $user->id && 
                                            $voter_relationship->type == 1)
                                            <a href="{{ url('vote/'.Auth::user()->id.'/'.$user->id.'/1') }}"><button type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i></button></a>
                                        
                                        @else
                                            <a href="{{ url('vote/'.Auth::user()->id.'/'.$user->id.'/1') }}"><button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></a>
                                        @endif

                                        @if($voter_relationship != null && $voter_relationship->vote_giver == Auth::user()->id && 
                                            $voter_relationship->vote_receiver == $user->id && 
                                            $voter_relationship->type == 0)
                                            <a href="{{ url('vote/'.Auth::user()->id.'/'.$user->id.'/0') }}"><button type="button" class="btn btn-outline-danger"><i class="fas fa-minus"></i></button></a>
                                        
                                        @else
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

        @auth
            @if(Auth::user()->id != $user->id)
                <div class="panel panel-default">
                    <div class="panel-heading">Message</div>
                    
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('message/'.$user->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea type="text" name="content" class="form-control" required></textarea>
                                    
                                    @if ($errors->has('content'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

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