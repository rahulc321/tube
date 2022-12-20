<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect()->route("admin.dashboard");
        }else{
            return view('auth.login');
        }
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where(['email'=>$request->email])->first();
        if(!$user){
            return redirect()->back()->withError('Email not valid');
        }
        if($user->hasRole('admin')){
            
        }elseif($user->hasRole('manager')){

        }else{
            return redirect()->back()->withError('Access Denied for this user');
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect()->back()->withError('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }
  
        return redirect()->route('login')->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
