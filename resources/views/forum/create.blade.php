@extends('layouts.app')

<!-- Page for User or Admin to Create a New Forum -->
@section('content')
<!-- Container for Forum Create Page -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Panel for Forum Create -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading">Forum Data</div>

                <!-- Panel Body -->
                <div class="panel-body">
                    <!-- Forum Create Form -->
                   <form class="form-horizontal" method="POST" action="{{ route('forum.store') }}" >
                        <!-- CSRF Field --> {{ csrf_field() }}

                        <!-- Form Group for Forum Title -->
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"><span class="required-item">*</span> Title</label>
                            
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                                
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
                                <select id="category" class="form-control" name="category" required>
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
                                <textarea id="content" type="text" class="form-control" name="content" required></textarea>
                                
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
                                    Add
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
