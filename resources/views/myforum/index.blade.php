@extends('layouts.app')
<style>
    .forum-title {
        padding-left: 0 !important;
    }

    .btn-circle {
        background-color: #333;
        color: white;
        width: 50px;
        height: 50px;
        border: 0;
        border-radius: 60px;
        float: right;
        position: fixed;
        bottom: 10px;
        right: 10px;
        cursor: pointer;
        transition-duration: 0.5s;
    }

    .btn-circle:hover {
        background-color: #B0FF84;
        color: #333;
        transition-duration: 0.5s;
    }

    .label {
        font-size: 12px !important;
    }
</style>

<!-- Page for User or Admin to See Forum that have been Created by Themselves -->
@section('content')
<!-- Container for My Forum Index -->
<div class="container" >
    <div class="row">    
        <div class="col-md-12">
            <!-- My Forum Search Box -->
            <form class="form-horizontal" method="POST" role="search" action="{{ url('search') }}">
                <!-- CSRF Field --> {{ csrf_field() }}
                
                <!-- Input Group for My Forum Search Box -->
                <div class= "input-group">
                    <input id="search" type="text" class="form-control" name="search" placeholder="Search Forum by Title or Category Name" required>
                    
                    <!-- Error Handler for My Forum Search Box -->
                    @if ($errors->has('search'))
                        <span class="help-block" role="alert">
                            <strong>{{ $errors->first('search') }}</strong>
                        </span>
                    @endif

                    <!-- Search Button -->
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                    </span>
                </div>
            </form>
        </div>
        
        <!-- Condition for No Forum -->
        @if(count($forums) == 0)
            <div class="text-center"><label>You haven't Posted any Forum(s)</label></div>
        
        @else
            <!-- For Each Forum in Forums Table -->
            @foreach($forums as $forum)
            <div class="col-md-12">
                <!-- Panel for Viewing List of Forums -->
                <div class="panel panel-default">
                    <!-- Panel Header -->
                    <div class="panel-heading">
                        <div class="col-md-9 forum-title">
                            <a href="{{ url('thread/'.$forum->id) }}">
                                <b>{{ $forum->title }}</b>
                            </a>
                        </div>
                    
                        <div class="col-md-3 text-right pull-right">
                            <!-- Condition for Forum Status : Open -->
                            @if($forum->status == 'open')
                                <!-- Edit Button -->
                                <a href="{{ url('forum/'.$forum->id.'/edit') }}"><button type="button" class="btn btn-warning text-right"><i class="fas fa-edit"></i> Edit</button></a>
                                <!-- Close Button -->
                                <a href="{{ url('forum/'.$forum->id.'/close') }}"><button type="submit" class="btn btn-danger text-right"><i class="fas fa-times"></i> Close</button></a>
                            @endif
                        </div>

                        <br>
                        Status : 
                        <!-- Condition for Forum Status : Open -->
                        @if($forum->status == 'open')
                            <label class="label label-success">Open</label>
                            
                        @else
                            <label class="label label-danger">Closed</label>
                        @endif
                    </div>
                    
                    <!-- Panel Body -->
                    <div class="panel-body">{{ $forum->content }}</div>
                </div>
            </div>
            @endforeach
            
            <!-- Pagination Links -->
            <div class="col-md-12 text-center">
                {{ $forums->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Condition for Aunthenticated User -->
@auth
    <!-- Add Forum Button -->
    <a href="{{ url('forum/create') }}"><button class="btn-circle"><i class="fas fa-plus"></i></button></a>
@endauth
@endsection