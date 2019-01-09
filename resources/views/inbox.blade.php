@extends('layouts.app')
@section('content')
<div class="container" >
    <div class="row justify-content-center">    
        
        @if(count($messages) == 0)
            <h4>You have no message</h4>
        @else
            @foreach($messages as $i=>$message)
            <div class="col-sm-12" style="margin-bottom:40px">
                <div class="card">
                    <div class="card-header " >
                        <h5 class="mt-2">
                        <div>
                            <a href="{{url('message/'.$message->id.'/delete')}}"><button type="submit" class="btn btn-danger ml-1 mr-1" style="float: right;"><i class="small material-icons">delete</i>Delete</button></a>
                            @if($message_id != $i)
                                <a href="{{url('message/reply/'.$message->receiver->id.'/'.$i)}}"><button type="submit" class="btn btn-primary ml-1 mr-1" style="float: right;"><i class="small material-icons">reply</i>Reply</button></a>
                            @endif
                        </div>
                        <img src="/uploads/avatars/{{$message->sender->avatar}}" class="ml-3" style="width:27px; height:27px;position:absolute;left:0px;border-radius:50%">
                        <a class="ml-5" href="{{url('profile/'.$message->sender->id)}}">{{$message->sender->name}}</a>
                        </h5>
                        
                        <p class="mt-1">{{$message->created_at}} </p>
                    </div>
                    <div class="col-xs-12 ml-3 mt-3 mb-1" >
                        <p class = "mt-1 ml-3"> {{$message->content}} </p>
                    </div>
                </div>
                @if($message_id == $i)
                    <div class="card-body">
                        <div class="col-xs-12 ml-2 mt-1" >
                        <h6><b>Reply {{$message->sender->name}}'s Message</b></h6>
                        </div>
                        <form method="POST" action="{{ url('message/reply/'.$message->sender->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12 mx-2 mt-1">
                                    <textarea type="text" name="content" class="form-control"></textarea>
                                    <button type="submit" class="btn btn-primary mt-4 col-sm-1 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" style="float: right;"><i class="small material-icons">reply</i>Reply</button>
                                    @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
            
                        </form>
                    </div>
                @endif
            </div>
            @endforeach
            <div class="col-sm-12" style="text-align: center;">
                {{$messages->links()}}
            </div>
        @endif
 
    </div>
</div>


@endsection