@extends('layouts.app')
<style>
    .user-profile-image {
        width: 35px; 
        height: 35px;
        top: 8px; 
    }
</style>

@section('content')
<!-- Inbox Container -->
<div class="container">
    <div class="row">    
        <div class="col-md-12">
            <!-- Condition for No Message -->
            @if(count($messages) == 0)
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading">You have no message</div>
            </div>
                
            @else
                <!-- For each Message in Messages Table -->
                @foreach($messages as $message)
                    <!-- Panel for Inbox -->
                    <div class="panel panel-default">
                        <!-- Panel Header -->
                        <div class="panel-heading">
                            <!-- Sender Name and Avatar -->
                            <img src="/avatars/{{ $message->sender->avatar }}" class="user-profile-image">
                            <span><a href="{{ url('profile/'.$message->sender->id) }}">{{ $message->sender->name }}</a></span>
                            
                            <!-- Delete Button -->
                            <div class="pull-right">
                                <a href="{{ url('message/'.$message->id.'/delete') }}"><button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Delete</button></a>
                            </div>
                            
                            <!-- Date -->
                            <br><br>      
                            {{ date("l, d-M-Y H:i:s", strtotime($message->created_at)) }}
                        </div>
                           
                        <!-- Panel Body -->     
                        <div class="panel-body">
                            {{ $message->content }}
                        </div>
                    </div>
                @endforeach
            @endif    
            </div>
        </div>
        
        <!-- Pagination Links -->
        <div class="text-center">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection