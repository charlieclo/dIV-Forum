@extends('layouts.app')

<!-- Page for Admin to Edit Category -->
@section('content')
<!-- Category Edit Container -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Panel for Category Edit -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading">Update Category</div>
                
                <!-- Panel Body -->
                <div class="panel-body">
                    <!-- Category Edit Form -->
                    <form class="form-horizontal" method="POST" action="{{ url('category/'.$categories->id.'/update') }}" >
                    <!-- CSRF Field --> {{ csrf_field() }}
                    <!-- Method Field : PUT --> {{ method_field('PUT') }}
                        
                        <!-- Form Group for Category Name -->
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"><span class="required-item">*</span> Category Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $categories->name }}" required autofocus>
                                
                                <!-- Error Handler for Category Name -->
                                @if ($errors->has('name'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Category Update Button -->
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