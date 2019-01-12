@extends('layouts.app')

<!-- Page for Admin to See All List of Forums that have been Created -->
@section('content')
<!-- Container for Forum Index Admin -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Panel for View Forum Index Admin -->
            <div class="panel panel-default">
                <!-- Panel Header -->
                <div class="panel-heading">List of Forum</div>

            <!-- Panel Body with Responsive Table -->
            <div class="panel-body table-responsive">
                <!-- Forums List Table -->
                <table class="table">
                    <!-- Table Head -->
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Owner</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        <!-- For Each Forum in Forums Table -->
                        @foreach($forums as $forum)
                            <tr>
                                <td class="text-center">{{ $forum->title }}</td>
                                <td class="text-center">{{ $forum->category->name }} </td>
                                <td class="text-center">{{ $forum->user->name }} </td>
                                <td class="text-center">{{ $forum->content }} </td>
                                <!-- Condition for Forum's Status : Open -->
                                @if($forum->status == 'open')
                                    <td class="text-center">Open</td>
                                
                                @else
                                    <td class="text-center">Close</td>
                                @endif
                                
                                <td class="text-center">
                                    <!-- Condition for Forum's Status : Open -->
                                    @if($forum->status == 'open')
                                        <!-- Enabled Close Button -->
                                        <a href="{{ url('forum/'.$forum->id.'/close') }}"><button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Close</button></a>
                                    
                                    @else
                                        <!-- Disabled Close Button -->
                                        <button type="button" class="btn btn-danger" disabled ><i class="fas fa-times"></i> Close</button>
                                    @endif

                                    <!-- Delete Button -->
                                    <a href="{{ url('forum/'.$forum->id.'/delete') }}"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="col-md-12 text-center">
                    {{ $forums->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection