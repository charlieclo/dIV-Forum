<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use App\Forum;
use Illuminate\Http\Request;
use Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int $forum_id
     * @return \Illuminate\Http\Response
     */
    public function index($forum_id)
    {
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
     * @param  int $forum_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $forum_id)
    {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $thread_id
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
     * @param  int  $thread_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $thread_id)
    {
        $thread = Thread::find($thread_id);
        $thread->content = $request->content;
        $thread->save();
        
        return redirect('thread/'.$thread->forum_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $thread_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread_id)
    {
        $thread = Thread::find($thread_id);
        $thread->delete();
        
        return redirect('thread/'.$thread->forum_id);
    }

    /**
     * Redirect search keyword created from search form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $forum_id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, $forum_id)
    {
        return redirect('thread/'.$forum_id.'/search='.$request->search);
    }

    /**
     * Search resource in storage based on keyword.
     *
     * @param  int $forum_id
     * @param  String $search
     * @return \Illuminate\Http\Response
     */
    public function searchThread($forum_id, $search) 
    {
        $threads = Thread::whereHas('forum', function($query) use($forum_id) {
            $query->where('id', 'like', "%{$forum_id}%");
        })->whereHas('user', function ($query) use($search) {
            $query->where('name', 'like', "%{$search}%");
        })->orWhere('content', 'like', "%{$search}%")->paginate(5);
        $forum = Forum::find($forum_id);

        return view('thread.index',compact('threads', 'forum'));
    }
}
