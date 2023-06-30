<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use DB;

class c_login extends Controller
{

    public function login_hki()
    {
        return view('login_hki');
    }

    public function login_subcon()
    {
        return view('login_subcon');
    }

    public function login_supplier()
    {
        return view('login_subcon');
    }


    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required'=>'Username wajib terisi',
            'password.required'=>'Password wajib terisi',
        ]);
        $user = $request->username;
        $pass = $request->password;
        if(auth()->attempt(array('username'=>$user,'password'=>$pass)))
        {
            $request->session()->put('id_user', Auth::user()->id);
            return redirect('/dashboard');
        }
        else
        {
            session()->flash('error', 'Username atau password salah');
            return redirect()->back();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
        // Auth::logout();
        // $request->session()->flush();
        // return redirect()->route('user.login');
    }

    // Login multiuser
    public function dashboard(){
        if (Auth::user()->role_id == "1") {
            return view('hki.dashboard');
        } elseif(Auth::user()->role_id == "2") {
            return view('subcon.dashboard');
        }elseif(Auth::user()->role_id == "3") {
            return view('supplier.dashboard');
        }
       
    }

   
}
