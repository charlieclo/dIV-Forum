<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       //Has been implemented in function store(Request $request)
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //Has been implemented in function store(Request $request)
    }
 
    /**
     * Create a new user instance after a valid registration.
     * 
     * @param  Request $request
     * @return \App\User
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
            'agree' => 'required',
        ], ['before' => 'Age must be more than 12',
            'regex' => 'Address must be ended with Street']);

        //Condition if Validator Fails
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        //Condition if Avatar was Inputted for Registry
        if($request->hasFile('avatar'))
        {   
            $image = $request->file('avatar');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/avatars');
            $image->move($path, $input['imagename']);
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'avatar' => $input['imagename'],
                'agree' => $request->agree,
                'good_vote' => 0,
                'bad_vote' => 0,
            ]);
        }

        //Condition if Avatar was not Inputted for Registry
        else
        {   
            $avatar = "default.png";

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'avatar' => $avatar,
                'agree' => $request->agree,
                'good_vote' => 0,
                'bad_vote' => 0,
            ]);
        }
        
        return redirect()->route('login');
    }
}
