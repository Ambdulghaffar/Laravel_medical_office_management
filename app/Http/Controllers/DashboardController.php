<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'role' => 'in:patient,doctor,secretary',
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->fill($request->all())->save();

        // Redirection avec un message de succès
        return redirect()->route('user.settings')->with('success', 'Tes informations ont été mises à jour avec succès.');
    }
}
