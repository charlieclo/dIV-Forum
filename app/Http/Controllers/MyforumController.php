<?php

namespace App\Http\Controllers;

use Auth;
use App\Forum;
use App\Category;
use Illuminate\Http\Request;

class MyForumController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return View
     */
    public function show(Request $request, $user_id)
    {
        if (Auth::user()->id == $user_id) {
        	$forums = Forum::where('user_id', $user_id)->paginate(5);
        	$categories = Category::all();
        	return view('myforum.index', compact('forums', 'categories'));
    	}

    	else {
    		return redirect()->route('home');
    	}
    }

}
