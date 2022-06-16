<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function index(){

        return view('login');
        // return Hash::make('adminsaham123');
    }


    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
           'password' => ['required'],
       ]);

       if (Auth::attempt($credentials)) {
       
           $request->session()->regenerate();
            

           return redirect()->intended('/');

       }


       return back()->with('loginError', 'Maaf Username atau password anda salah');

    }

    public function logout(){
        Auth::logout();

        // invalidate session nya biar gak di pake 
        request()->session()->invalidate();

        // bikin baru token nya supaya gak dibajak
        request()->session()->regenerateToken();
    
        return redirect('/login');
    }
}
