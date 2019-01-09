<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Category;
use Illuminate\Http\Request;

class MyforumController extends Controller
{
    //
    public function index(Request $request, $user_id)
    {
        $forums = Forum::where('user_id', $user_id)->paginate(5);
        $categories = Category::all();
        return view('myforum.index', compact('forums', 'categories'));
    }

}
