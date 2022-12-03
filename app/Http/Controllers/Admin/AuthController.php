<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_view(){
        return view('login');
    }//end login view

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if (auth('admin')->attempt($credentials)) {
            session()->flash('success','done');
            return 'done';
            // end login admin logic 
        }else{
            session()->flash('error',__('login_register.login.Oppes!_You_have_entered_invalid_credentials'));
            return redirect()->route('login.view');
        }
    }// end post login func

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('login.view');
    }// end logout func
}
