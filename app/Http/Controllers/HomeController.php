<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forum.index');
    }
    public function check()
    {
        if(Auth::user()->admin==0){
            return redirect('/forum');
        } else {
            $users['users'] = \App\User::all();
            return view('admin', $users);
        }
    }
}
