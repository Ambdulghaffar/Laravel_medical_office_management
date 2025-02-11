<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //

    public function index(){
        return view ('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]) ;

                // Création de l'utilisateur
                User::create([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'password' => Hash::make($request->password), // Hachage du mot de passe
                ]);

        //redirect()->route('/home');



    }
}
