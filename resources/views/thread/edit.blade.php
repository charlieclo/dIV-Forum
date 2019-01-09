@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Thread Content</div>

                <div class="card-body">
                   <form action="{{url('thread/'.$thread->id.'/update')}}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                        <div class="form-group">
                          <label for="content"> Content</label>
                          <textarea type="text" name="content" class="form-control">{{$thread->content}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float:right;">Update</button>
                            
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
