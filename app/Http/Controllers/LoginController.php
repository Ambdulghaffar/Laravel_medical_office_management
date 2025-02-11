<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view("auth.login");
    }

    public function store(Request $request){
        $user=$request->validate([
            'role'=>'required|string',
            'email'=>'required|email',
            'password' => 'required|string|min:8',
        ]);

        if(Auth::attempt($user)){
            return redirect()->route('home');
        }

    }
}
