<?php

namespace App\Http\Controllers;

use Auth;
use App\Thread;
use App\User;
use App\Forum;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($forum_id)
    {
        //
        $threads = Thread::where('forum_id', $forum_id)->paginate(5);
        $forum = Forum::find($forum_id);
        return view('thread.index', compact('threads', 'forum'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $forum_id)
    {
        //
        $thread = New Thread;
        $thread->content = $request->content;
        $thread->forum_id = $forum_id;
        $thread->user_id = Auth::user()->id;
        $thread->status = 'active';
        $thread->save();
        return redirect('thread/'.$forum_id);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($thread_id)
    {
        $thread = Thread::find($thread_id);
        return view('thread.edit', compact('thread'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $thread_id)
    {
        //
        $thread = Thread::find($thread_id);
        $thread->content = $request->content;
        $thread->save();
        return redirect('thread/'.$thread->forum_id);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread_id)
    {
        //
        $thread = Thread::find($thread_id);
        $forum_id = $thread->forum_id;
        $thread->delete();
        return redirect('thread/'.$forum_id);
    }
    
    public function searchthread(Request $request, $forum_id)
    {
        $threads = Thread::where('content', 'like', "%{$request->search}%")->paginate(5);
        //$users = User::where('name', 'like', "%{$request->search}%")->paginate(5);
        $forum = Forum::find($forum_id);
        return view('thread.index',compact('threads', 'forum'));
    }
}
