@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forum Data</div>

                <div class="panel-body">
                   <form class="form-horizontal" method="POST" action="{{ route('forum.store') }}" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label"><span class="required-item">*</span> Title</label>
                            
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Category</label>
                            
                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-md-4 control-label">Description</label>
                            
                            <div class="col-md-6">
                                <textarea id="content" type="text" class="form-control" name="content" required></textarea>
                            </div>
                        </div>

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
