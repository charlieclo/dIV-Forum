@extends('layouts.app')
<style>
    .user-image-list {
        width: 35px;
        height: 35px;
    }
</style>

<!-- Page for Admin to View All Users List -->
@section('content')
<!-- Container for User Index -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Panel for Viewing Users List -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading" style="padding-bottom: 5px; padding-top: 5px;">
                    <label style="padding-top: 10px;">List of User</label> 
                    <!-- Add New User Button -->
                    <a href="{{ url('user/create') }}" class="pull-right"><button type="submit" class="btn btn-success">Add New User</button></a>
                </div>
                
                <!-- Panel Body with Responsive Table -->
                <div class="panel-body table-responsive">
                    <!-- Users List Table -->    
                    <table class="table">
                        <!-- Table Head -->
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Birthday</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                  
                        <!-- Table Body -->
                        <tbody>
                            @foreach($users as $id => $user)
                                <tr>
                                    <td class="text-center">{{ $users->firstItem() + $id }}</td>
                                    <td class="text-center"><img src="/avatars/{{ $user->avatar }}" class="user-image-list"></td>
                                    <td class="text-center"><a href="{{ url('profile/'.$user->id) }}">{{ $user->name }}</a></td>
                                    
                                    @if ($user->admin == 1)
                                        <td class="text-center">Admin</td> 
                                    
                                    @else 
                                        <td class="text-center">Member</td>
                                    @endif

                                    <td class="text-center">{{$user->email}}</td>
                                    <td class="text-center">{{$user->phone}}</td>
                                    <td class="text-center">{{$user->address}}</td>
                                    <td class="text-center">{{$user->dob}}</td>
                                    <td class="text-center">{{$user->gender}}</td>
                                    <td class="text-center">
                                        <!-- Edit User Button -->
                                        <a href="{{ url('user/'.$user->id.'/edit') }}"><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                                        <!-- Delete User Button -->
                                        <a href="{{ url('user/'.$user->id.'/delete') }}"><button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection