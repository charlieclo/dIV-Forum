@extends('layouts.app')
<style>
    .label {
        font-size: 12px !important;
    }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>{{ $forum->title }}</b>
                    
                    @if ($forum->status == 'open')
                        <label class="label label-success pull-right">Open</label>
                    
                    @else
                        <label class="label label-danger pull-right">Closed</label>
                    @endif

                    <br>
                    Category    : {{ $forum->category->name }}
                    <br>
                    Owner       : <a href="{{ url('profile/'.$forum->user->id) }}">{{ $forum->user->name }}</a> 
                    <br>
                    Posted at   : {{ $forum->created_at }}
                    <br><br>
                    Description : 
                    <br>
                    {{ $forum->content }}
                    <br><br>

                    <form class="form-horizontal" method="POST" role="search" action="{{ url('thread/'.$forum->id.'/searchthread') }}">
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

                <div class="panel-body">
                    @if(count($threads) == 0)
                        <div class="text-left"><label>This Forum has no Thread</label></div>
                    
                    @else
                        @foreach($threads as $thread)       
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a href="{{ url('profile/'.$thread->user->id) }}">
                                            <b>{{ $thread->user->name }}</b>
                                        </a>

                                        @auth
                                            @if($thread->user_id == Auth::user()->id && $forum->status == 'open')
                                                <div class="pull-right"> 
                                                    <a href="{{ url('thread/'.$thread->id.'/edit') }}"><button type="button" class="btn btn-warning text-right"><i class="fas fa-edit"></i> Edit</button></a>
                                                    <a href="{{ url('thread/'.$thread->id.'/delete') }}"><button type="submit" class="btn btn-danger text-right"><i class="fas fa-times"></i> Close</button></a>
                                                </div>
                                            @endif
                                        @endauth

                                        <br>
                                        @if ($thread->user->admin == 1)
                                            Admin
                                        @else
                                            Member
                                        @endif

                                        <br>
                                        Posted at: {{ $thread->created_at }}
                                    </div>

                                    <div class="panel-body">{{ $thread->content }}</div>
                                </div>
                            </div>

                            <div class="text-center">{{ $threads->links() }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            @auth
                <div class="panel panel-default">
                    <div class="panel-heading">Post New Thread</div>

                    <div class="panel-body">
                        @if($forum->status == 'open')
                            Content
                            
                            <form class="form-horizontal" method="POST" action="{{ url('thread/'.$forum->id) }}" enctype="multipart/form-data">
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
                                            <i class="fab fa-telegram-plane"></i> Post
                                        </button>
                                    </div>
                                </div>
                            </form>

                        @else
                            <div class="text-center">This forum has been closed</div>
                        @endif
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection