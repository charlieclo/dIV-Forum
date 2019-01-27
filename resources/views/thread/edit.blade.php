@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Thread Content</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url('thread/'.$thread->id.'/update')}}">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}

                        <div class="form-group">
                            <label for="content" class="col-md-1">Content</label>
                            
                            <div class="col-md-12">
                                <textarea id="content" type="text" name="content" class="form-control" required>{{ $thread->content }}</textarea>    
                                
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
                                    <i class="fab fa-telegram-plane"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
