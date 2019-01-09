@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List of Forum</div>

            <div class="panel-body table-responsive">
                <table class="table">
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

                    <tbody>
                        @foreach($forums as $forum)
                        <tr>
                            <td class="text-center">{{ $forum->title }}</td>
                            <td class="text-center">{{ $forum->category->name }} </td>
                            <td class="text-center">{{ $forum->user->name }} </td>
                            <td class="text-center">{{ $forum->content }} </td>
                            @if($forum->status == 'open')
                                <td class="text-center">Open</td>
                            
                            @else
                                <td class="text-center">Close</td>
                            @endif
                            
                            <td class="text-center">
                                @if($forum->status == 'open')
                                    <a href="{{ url('forum/'.$forum->id.'/close') }}"><button type="button" class="btn btn-danger"><i class="fas fa-times"></i> Close</button></a>
                                
                                @else
                                    <button type="button" class="btn btn-danger btn-sm ml-1 mr-1 btn-o" disabled ><i class="fas fa-times"></i> Close</button>
                                @endif

                                <a href="{{ url('forum/'.$forum->id.'/delete') }}"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="col-md-12 text-center">
                    {{ $forums->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection