@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" >Add New Category</div>
                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('category') }}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><span class="required-item">*</span> Category Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
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

            <div class="panel panel-default">
                <div class="panel-heading">List of Category</div>
                
                <div class="panel-body">
                    @if(count($categories) == 0)
                        <label>You have no Category</label>
                    
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($categories as $id => $category)
                                    <tr>
                                        <td class="text-center">{{ $categories->firstItem() + $id }} </td>
                                        <td class="text-center">{{ $category->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('category/'.$category->id.'/edit') }}"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                                            <a href="{{ url('category/'.$category->id.'/delete') }}"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button></a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                        <div class="text-center">
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection