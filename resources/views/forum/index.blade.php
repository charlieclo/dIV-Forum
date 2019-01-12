@extends('layouts.app')
<style>
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

<!-- Page for Viewing List of Forums to Guest, User, or Admin -->
@section('content')
<!-- Container for Forum Index -->
<div class="container" >
    <div class="row">    
        <div class="col-md-12">
            <!-- Forum Search Box -->
            <form class="form-horizontal" method="POST" role="search" action="{{ url('forum/search') }}">
                <!-- CSRF Field --> {{ csrf_field() }}
                
                <!-- Input Group for Forum Search Box -->
                <div class= "input-group">
                    <input id="search" type="text" class="form-control" name="search" placeholder="Search Forum by Title or Category Name" required>
                    
                    <!-- Error Handler for Forum Search Box -->
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
           <div class="text-center"><label>No Forum(s) Available</label></div>
        
        @else
            <!-- For Each Forum in Forums Table -->
            @foreach ($forums as $forum)
                <div class="col-md-12">
                    <!-- Panel for Viewing List of Forums -->
                    <div class="panel panel-default">
                        <!-- Panel Header -->
                        <div class="panel-heading">
                            <a href="{{ url('thread/'.$forum->id) }}">
                                <b>{{ $forum->title }}</b>
                            </a>
                            
                            <!-- Condition for Forum Status : Open -->
                            @if ($forum->status == 'open')
                                <label class="label label-success pull-right">Open</label>
                            
                            @else
                                <label class="label label-danger pull-right">Closed</label>
                            @endif
                            
                            <br>
                            Category  : {{ $forum->category->name }}
                            <br>
                            Posted at : {{ date("d-M-Y H:i:s", strtotime($forum->created_at)) }}
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
    <!-- Forum Add Button -->
    <a href="{{ url('forum/create') }}"><button class="btn-circle"><i class="fas fa-plus"></i></button></a>
@endauth
@endsection