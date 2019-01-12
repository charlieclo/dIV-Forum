@extends('layouts.app')

<!-- Page for User or Admin that Created this Forum -->
@section('content')
<!-- Container for Forum Edit -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Panel for Forum Edit -->
            <div class="panel panel-default">
                <!-- Panel Heading  -->
                <div class="panel-heading">Forum Data</div>

                <!-- Panel Body -->
                <div class="panel-body">
                   <form class="form-horizontal" method="POST" action="{{ route('forum.update',$forum->id) }}">
                        <!-- CSRF Field --> {{ csrf_field() }}
                        <!-- Method Field : PUT --> {{ method_field('PUT') }}
                        
                        <!-- Form Group for Forum Title -->
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            
                            <div class="col-md-6">
                                <input id="title" type="text" name="title" class="form-control" value="{{ $forum->title }}" required>
                            
                                <!-- Error Handler for Forum Title -->    
                                @if ($errors->has('title'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Form Group for Forum's Category Select -->
                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Category</label>
                                
                            <div class="col-md-6">
                                <select id="category" name="category" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <!-- Error Handler for Forum's Category Select -->
                                @if ($errors->has('category'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Form Gorup for Forum Description -->
                        <div class="form-group">
                            <label for="content" class="col-md-4 control-label">Description</label>
                            
                            <div class="col-md-6">
                                <textarea id="content" type="text" name="content" class="form-control" required>{{ $forum->content }}</textarea>    
                            
                                <!-- Error Handler for Forum Description -->
                                @if ($errors->has('content'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>  
                        </div>
                        
                        <!-- Forum Add Button -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
