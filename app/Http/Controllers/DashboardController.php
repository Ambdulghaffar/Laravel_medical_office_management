<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('dashboard.dashboard');
    }

    public function settings(){
         return view('dashboard.users.settings');
    }

    public function update_settings(Request $request ,$id){
        $user = User::findOrFail($id);

        // Validation des données
        $request->validate([
            'name' => 'string|max:255',
            'lastname' => 'string|max:255',
            'address' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'phone' => 'string|regex:/^\+?[0-9]{10,15}$/|unique:users,phone,' . $id,
            'sex'=>'string|in:male,female',
            'birthday'=>'string|max:255',
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->fill($request->all())->save();

        // Redirection avec un message de succès
        return redirect()->route('user.settings')->with('success', 'Tes informations ont été mises à jour avec succès.');
    }


    public function update_password(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Valider les champs
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Vérifier si le mot de passe actuel est correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mettre à jour le mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.settings')->with('success', 'Mot de passe mis à jour avec succès.');
    }

}
