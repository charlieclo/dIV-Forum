<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Category;
use Illuminate\Http\Request;
use Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::paginate(5);
        // return $forums;
        return view('forum.index', compact('forums'));
    }

    /**
     * Display a listing of the resource for AS.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        if(Auth::user()->admin == 1) {
            $forums = Forum::paginate(10);
            
            return view('forum.index-admin', compact('forums'));    
        }

        else {
            return redirect('forum');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('forum.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $forums = New Forum;
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->category_id = $request->category;
        $forums->content = $request->content;
        $forums->save();

        return redirect('forum');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $forum_id
     * @return \Illuminate\Http\Response
     */
    public function edit($forum_id)
    {
        $forum = Forum::find($forum_id);
        $categories = Category::all();

        return view('forum.edit', compact('forum', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $forum_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $forum_id)
    {
        $forums = Forum::find($forum_id);
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->category_id = $request->category;
        $forums->content = $request->content;
        $forums->save();

        return redirect('forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $forum_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($forum_id)
    {
        $forums = Forum::find($forum_id);
        $forums->delete();
        
        return view('forum.master', compact('forums'));
    }

    /**
     * Redirect search keyword created from search form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return redirect('forum/0/search='.$request->search);
    }

    /**
     * Search resource in storage based on keyword.
     *
     * @param  String $search
     * @return \Illuminate\Http\Response
     */
    public function searchForum($search)
    {   
        $forums = Forum::whereHas('category', function ($query) use($search) {
            $query->where('name', 'like', "%{$search}%");
        })->orWhere('title', 'like', "%{$search}%")->paginate(5);
        
        return view('forum.index', compact('forums'));
    }

    /**
     * Close the specified resoruce.
     *
     * @param  int $forum_id
     * @return \Illuminate\Http\Response
     */
    public function close($forum_id) {
        $forum = Forum::find($forum_id);
        $forum->status = 'close';
        $forum->save();

        return back();
    }
}
