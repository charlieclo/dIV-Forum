<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\VoterRelationship;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    //
    public function profile($id)
    {   
        $login_user = 0;
        if(Auth::user() != null){
            $login_user = Auth::user()->id;
        }
        $user = User::find($id);

        if($user == null){
            return redirect('profile/'.Auth::user()->id);
        }

        $voter_relationship = VoterRelationship::where('vote_giver', $login_user)->where('vote_receiver', $id)->first();
        return view('profile', compact('user', 'voter_relationship'));
    }
    
    public function index(){
        if(Auth::user()->admin == 0){
            return redirect('forum');
        }

        $users = User::paginate(10);
        return view('user.index', compact('users'));
    }

    public function destroy($user_id){
        $user = User::find($user_id);
        $user->delete();
        return back();
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){

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
            $user->plus_popularity = $default;
            $user->minus_popularity = $default;
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
            $user->plus_popularity = $default;
            $user->minus_popularity = $default;
            $user->save();
        }

        return $this->index();
    }

    public function edit($id)
    {
        if(Auth::user()->id == $id || Auth::user()->admin == 1) {
            $user = User::find($id);
            return view('user.edit', compact('user'));
        }

        else {
            return redirect('forum');
        }
    }

    public function update(Request $request, $id)
    {
        if($request->hasFile('avatar'))
        {   
            $image = $request->file('avatar');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/avatars');
            $image->move($path, $input['imagename']);
            
            $user = User::find($id);
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
            $user = User::find($id);
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
    public function editprofile($id)
    {
        if(Auth::user()->id == $id || Auth::user()->admin == 1){
            $user = User::find($id);
            return view('userprofile.edit', compact('user'));
        }

        else {
            return redirect('forum');
        }
    }
    public function updateprofile(Request $request, $id)
    {
        if($request->hasFile('avatar'))
        {   
            $image = $request->file('avatar');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/avatars');
            $image->move($path, $input['imagename']);
            
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->avatar = $input['imagename'];
            $user->admin = $user->admin;
            $user->agree = 'agree';
            $user->save();
        }

        else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->admin = $user->admin;
            $user->agree = 'agree';
            $user->save();
        }
        
        return redirect('profile/'.$id);
    }
}
