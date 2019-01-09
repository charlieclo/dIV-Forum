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
           <div class="text-center"><label>No Forum(s) Available</label></div>
        
        @else
            @foreach ($forums as $forum)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ url('thread/'.$forum->id) }}">
                                <b>{{ $forum->title }}</b>
                            </a>
                            
                            @if ($forum->status == 'open')
                                <label class="label label-success pull-right">Open</label>
                            
                            @else
                                <label class="label label-danger pull-right">Closed</label>
                            @endif
                            
                            <br>
                            Category  : {{$forum->category->name}}
                            <br>
                            Posted at : {{$forum->created_at}}
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