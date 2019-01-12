@extends('layouts.app')
<style>
    .label {
        font-size: 12px !important;
    }
</style>

<!-- Page for Viewing Threads in Current Forum -->
@section('content')
<!-- Container for Thread Index -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Panel for Viewing Current Forum -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading">
                    <b>{{ $forum->title }}</b>
                    
                    <!-- Condition for Forum's Status : Open -->
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

                    <!-- Thread Search Box Form -->
                    <form class="form-horizontal" method="POST" role="search" action="{{ url('thread/'.$forum->id.'/search') }}">
                        <!-- CSRF Field --> {{ csrf_field() }}
                        
                        <!-- Input Group for Thread Search Box -->
                        <div class= "input-group">
                            <input id="search" type="text" class="form-control" name="search" placeholder="Search Forum's Thread by Content or Owner" required>
                            
                            <!-- Error Handler for Thread Search Box -->
                            @if ($errors->has('search'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('search') }}</strong>
                                </span>
                            @endif

                            <!-- Thread Search Button -->
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                            </span>
                        </div>
                    </form>
                </div>

                <!-- Panel Body -->
                <div class="panel-body">
                    <!-- Condition for No Thread -->
                    @if(count($threads) == 0)
                        <div class="text-left"><label>This Forum has no Thread</label></div>
                    
                    @else
                        <!-- For Each Thread in Threads Table -->
                        @foreach($threads as $thread)       
                            <div class="col-md-12">
                                <!-- Panel for Viewing Threads -->
                                <div class="panel panel-default">
                                    <!-- Panel Header -->
                                    <div class="panel-heading">
                                        <a href="{{ url('profile/'.$thread->user->id) }}">
                                            <b>{{ $thread->user->name }}</b>
                                        </a>

                                        <!-- Condition for Authenticated User -->
                                        @auth
                                            <!-- Condition for Thread's User ID is same like Authenticated User's ID and Forum Status : Open -->
                                            @if($thread->user_id == Auth::user()->id && $forum->status == 'open')
                                                <div class="pull-right"> 
                                                    <!-- Edit Thread Button -->
                                                    <a href="{{ url('thread/'.$thread->id.'/edit') }}"><button type="button" class="btn btn-warning text-right"><i class="fas fa-edit"></i> Edit</button></a>
                                                    <!-- Delete Thread Button -->
                                                    <a href="{{ url('thread/'.$thread->id.'/delete') }}"><button type="submit" class="btn btn-danger text-right"><i class="fas fa-times"></i> Delete</button></a>
                                                </div>
                                            @endif
                                        @endauth

                                        <br>
                                        <!-- Condition for Thread's User Role -->
                                        @if ($thread->user->admin == 1)
                                            Admin
                                        @else
                                            Member
                                        @endif

                                        <br>
                                        Posted at: {{ $thread->created_at }}
                                    </div>

                                    <!-- Panel Body -->
                                    <div class="panel-body">{{ $thread->content }}</div>
                                </div>
                            </div>

                            <!-- Pagination Links -->
                            <div class="text-center">
                                {{ $threads->links() }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Condition for Authenticated User -->
            @auth
                <!-- Panel for Post New Thread -->
                <div class="panel panel-default">
                    <!-- Panel Header -->
                    <div class="panel-heading">Post New Thread</div>

                    <!-- Panel Body -->
                    <div class="panel-body">
                        <!-- Condition for Forum Status : Open -->
                        @if($forum->status == 'open')
                            Content
                            
                            <!-- New Thread Form -->
                            <form class="form-horizontal" method="POST" action="{{ url('thread/'.$forum->id.'/store') }}" enctype="multipart/form-data">
                                <!-- CSRF Field --> {{ csrf_field() }}
                                
                                <!-- Form Group for Thread Content -->
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea type="text" name="content" class="form-control" required></textarea>
                                            
                                        <!-- Error Handler for Thread Content -->
                                        @if ($errors->has('content'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Post Thread Button -->
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