<?php

namespace App\Http\Controllers;

use App\User;
use App\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin == 1) {
            $users = User::paginate(10);
            
            return view('user.index', compact('users'));
        }

        return redirect('forum');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator to Validate all Requests
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric',
            'address' => array('required', 'regex:/(^[A-Za-z 0-9.,]+ Street$)/'),
            'dob' => 'required|before: 12 years ago',
            'gender'=> 'required',
            'role' => 'admin',
        ], ['before' => 'Age must be more than 12',
            'regex' => 'Address must be ended with Street']);

        //Condition if Validator Fails
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        if($request->hasFile('avatar'))
        {   
            $image = $request->file('avatar');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/avatars');
            $image->move($path, $input['imagename']);
            
            $default = 0;
            $user = New User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone =$request->phone;
            $user->address =$request->address;
            $user->dob =$request->dob;
            $user->gender = $request->gender;
            $user->avatar = $input['imagename'];
            $user->admin = $request->role == 'Admin' ? 1 : 0;
            $user->agree = 'agree';
            $user->good_vote = $default;
            $user->bad_vote = $default;
            $user->save();
        }

        else
        {
            $default = 0;
            $user = New User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone =$request->phone;
            $user->address =$request->address;
            $user->dob =$request->dob;
            $user->gender = $request->gender;
            $user->avatar = "default.png";
            $user->admin = $request->role == 'Admin' ? 1 : 0;
            $user->agree = 'agree';
            $user->good_vote = $default;
            $user->bad_vote = $default;
            $user->save();
        }

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user_logged = 0;
        if(Auth::user() != null){
            $user_logged = Auth::user()->id;
        }

        $user = User::find($user_id);

        if($user == null) {
            return redirect('profile/'.Auth::user()->id);
        }

        $voter = Voter::where('vote_sender', $user_logged)->where('vote_receiver', $user_id)->first();
        
        return view('profile.index', compact('user', 'voter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        if(Auth::user()->id == $user_id || Auth::user()->admin == 1){
            $user = User::find($user_id);
            
            return view('profile.edit', compact('user'));
        }

        else {
            return redirect('forum');
        }
    }

     /**
     * Show the form for editing the specified resource for admin.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function editUser($user_id)
    {
        if(Auth::user()->id == $user_id || Auth::user()->admin == 1) {
            $user = User::find($user_id);
            
            return view('user.edit', compact('user'));
        }

        else {
            return redirect('forum');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        // Validator to Validate all Requests
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric',
            'address' => array('required', 'regex:/(^[A-Za-z 0-9.,]+ Street$)/'),
            'dob' => 'required|before: 12 years ago',
            'gender'=> 'required',
        ], ['before' => 'Age must be more than 12',
            'regex' => 'Address must be ended with Street']);

        //Condition if Validator Fails
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        if($request->hasFile('avatar'))
        {   
            $image = $request->file('avatar');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/avatars');
            $image->move($path, $input['imagename']);
            
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->avatar = $input['imagename'];
            $user->admin = $request->role == 'Admin' ? 1 : 0;
            $user->agree = 'agree';
            $user->save();
        }

        else {
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->admin = $request->role == 'Admin' ? 1 : 0;
            $user->agree = 'agree';
            $user->save();
        }
        
        return redirect('profile/'.$user_id);
    }

    /**
     * Update the specified resource for admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $user_id)
    {
        // Validator to Validate all Requests
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric',
            'address' => array('required', 'regex:/(^[A-Za-z 0-9.,]+ Street$)/'),
            'dob' => 'required|before: 12 years ago',
            'gender'=> 'required',
        ], ['before' => 'Age must be more than 12',
            'regex' => 'Address must be ended with Street']);

        //Condition if Validator Fails
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        if($request->hasFile('avatar'))
        {   
            $image = $request->file('avatar');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/avatars');
            $image->move($path, $input['imagename']);
            
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->avatar = $input['imagename'];
            $user->admin = $request->role == 'Admin' ? 1 : 0;
            $user->agree = 'agree';
            $user->save();
        }

        else {
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->admin = $request->role == 'Admin' ? 1 : 0;
            $user->agree = 'agree';
            $user->save();
        }
        
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return back();
    }
}
