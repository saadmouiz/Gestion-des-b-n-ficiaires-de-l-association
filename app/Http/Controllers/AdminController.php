<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Soumettre le formulaire de connexion
    public function login(Request $request)
    {
        // Valider les données
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); 

        // Essayer de se connecter
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('folders.index'); // Rediriger vers la liste des bénéficiaires
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    // Déconnexion
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login'); // Rediriger vers la page de login
    }
}
