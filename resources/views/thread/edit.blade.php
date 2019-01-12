@extends('layouts.app')

<!-- Page for User and Admin that Created this Thread --> 
@section('content')
<!-- Container for Thread Edit -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Panel for Thread Edit -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading">Edit Thread Content</div>

                <!-- Panel Body -->
                <div class="panel-body">
                    <!-- Edit Thread Form -->
                    <form class="form-horizontal" method="POST" action="{{url('thread/'.$thread->id.'/update')}}">
                        <!-- CSRF Field --> {{ csrf_field() }}
                        <!-- Method Field : PUT --> {{method_field('PUT')}}

                        <!-- Form Group for Thread Content -->
                        <div class="form-group">
                            <label for="content" class="col-md-1">Content</label>
                            
                            <div class="col-md-12">
                                <textarea id="content" type="text" name="content" class="form-control" required>{{ $thread->content }}</textarea>    
                                
                                <!-- Error Handler for Thread Content -->
                                @if ($errors->has('content'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Update Thread Button -->
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
