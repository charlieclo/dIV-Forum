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
        return view('forum.index',compact('forums'));
    }
    public function indexmaster()
    {
        $forums = Forum::paginate(10);
        // return $forums;
        return view('forum.master',compact('forums'));
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
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forum = Forum::find($id);
        $categories = Category::all();
        return view('forum.edit', compact('forum', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $forums = Forum::find($id);
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
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy($forum_id)
    {
        $forums = Forum::find($forum_id);
        $forums->delete();
        return view('forum.master',compact('forums'));
    }
    public function search(Request $request)
    {
        // $category_ids = Category::where('name', 'like', "%{$request->search}%")->get()->toArray();
        // dd($category_ids);
        // $forums = Forum::whereHas('category_id', $category_ids)->orWhere('title', 'like', "%{$request->search}%")->paginate(5);
        $search = $request->search;
        $forums = Forum::whereHas('category', function ($query) use($search){
            $query->where('name', 'like', "%{$request->search}%");
        })->orWhere('title', 'like', "%{$request->search}%")->paginate(5);
        return view('forum.index',compact('forums'));
    }
    public function close($forum_id){
        $forum = Forum::find($forum_id);
        $forum->status = 'close';
        $forum->save();
        //return redirect('myforum/'.Auth::user()->id);
        return back();
    }
}
