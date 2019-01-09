@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forum Data</div>

                <div class="panel-body">
                   <form action="{{ route('forum.store') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title"> Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title..">
                        </div>
                        <div class="form-group">
                            <label for="category"> Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">--select category--</option>
                                <option value="Science">Science</option>
                                <option value="Game">Game</option>
                                <option value="K-Drama">K-Drama</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="content"> Description</label>
                            <textarea type="text" name="content" class="form-control" placeholder="Description.."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                            
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
