<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    function index(){
        return view('login');
    }


    function login(Request $request){
        
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        $email = $request->email;
        $password = $request->password;

        //check in database
        if (Auth::attempt(['email'=>$email,'password'=>$password])) {
            return redirect('/dashboard')->with('success','You are logged in');
        } else {
            return back()->with('error','Invalid credentials');
        }
    }



}
