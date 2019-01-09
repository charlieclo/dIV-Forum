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

@section('content')
<div class="container" >
    <div class="row">    
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" role="search" action="{{ url('search') }}">
                {{ csrf_field() }}
                
                <div class= "input-group">
                    <input id="search" type="text" class="form-control" name="search" placeholder="Search Forum by Title or Category Name" required>
                    
                    @if ($errors->has('search'))
                        <span class="help-block" role="alert">
                            <strong>{{ $errors->first('search') }}</strong>
                        </span>
                    @endif

                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                    </span>
                </div>
            </form>
        </div>
        
        @if(count($forums) == 0)
            <div class="text-center"><label>You haven't Posted any Forum(s)</label></div>
        
        @else
            @foreach($forums as $forum)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-md-9 forum-title">
                            <a href="{{ url('thread/'.$forum->id) }}">
                                <b>{{ $forum->title }}</b>
                            </a>
                        </div>
                    
                        <div class="col-md-3 text-right pull-right">
                            @if($forum->status == 'open')
                                <a href="{{ url('forum/'.$forum->id.'/edit') }}"><button type="button" class="btn btn-warning text-right"><i class="fas fa-edit"></i> Edit</button></a>
                                <a href="{{ url('forum/'.$forum->id.'/close') }}"><button type="submit" class="btn btn-danger text-right"><i class="fas fa-times"></i> Close</button></a>
                            @endif
                        </div>

                        <br>
                        Status : 
                        @if($forum->status == 'open')
                            <label class="label label-success">Open</label>
                            
                        @else
                            <label class="label label-danger">Closed</label>
                        @endif
                    </div>
                    
                    <div class="panel-body">{{ $forum->content }}</div>
                </div>
            </div>
            @endforeach
            
            <div class="col-md-12 text-center">
                {{ $forums->links() }}
            </div>
        @endif
    </div>
</div>

@auth
    <a href="{{ url('forum/create') }}"><button class="btn-circle"><i class="fas fa-plus"></i></button></a>
@endauth
@endsection