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

        if(Auth::attempt(['role'=>$user['role'],'email' => $user['email'], 'password' => $user['password']])){
            return redirect()->route('dashboard');
        } 
                    // Échec de connexion
        return back()->withErrors(['email' => 'Informations incorrect.'])->withInput();
        

    }
}
