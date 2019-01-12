@extends('layouts.app')

<!-- Page for Admin to Add a New Category and See List of All Categories 
     and also Redirect to Edit Category Page or Delete Category -->
@section('content')
<!-- Container for Category Index Page -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Panel for Add New Category -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading" >Add New Category</div>
                
                <!-- Panel Body -->
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('category') }}">
                        <!-- CSRF Field --> {{ csrf_field() }}
                        
                        <!-- Form Group for Category Name -->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><span class="required-item">*</span> Category Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <!-- Category Add Button -->
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

            <!-- Panel for Viewing List of Categories -->
            <div class="panel panel-default">
                <!-- Panel Heading -->
                <div class="panel-heading">List of Category</div>
                
                <!-- Panel Body -->
                <div class="panel-body">
                    <!-- Condition for No Category -->
                    @if(count($categories) == 0)
                        <label>You have no Category</label>
                    
                    @else
                        <!-- Categories List Table -->
                        <table class="table">
                            <!-- Table Head -->
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            
                            <!-- Table Body -->
                            <tbody>
                                <!-- For Each Category in Categories Table -->
                                @foreach($categories as $id => $category)
                                    <tr>
                                        <td class="text-center">{{ $categories->firstItem() + $id }} </td>
                                        <td class="text-center">{{ $category->name }}</td>
                                        <td class="text-center">
                                            <!-- Edit Category Button -->
                                            <a href="{{ url('category/'.$category->id.'/edit') }}"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
                                            <!-- Delete Category Button -->
                                            <a href="{{ url('category/'.$category->id.'/delete') }}"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                        <!-- Pagination Links -->
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