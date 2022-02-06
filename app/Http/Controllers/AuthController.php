<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }  
      
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('campaign')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return view('index');
    //     }
  
    //     return redirect("login")->withSuccess('You are not allowed to access');
    // }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

}
