<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function showForm()
    {
        return view('admin.createForm');
    }
    
    public function createUser(Request $request)
        {
        // Valider les données du formulaire
        $request->validate([
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_type' => 'admin', // Profil par défaut
        ]);
        
        return redirect()->route('login');
    }
    public function showFormLogin()
    {
        return view('admin.loginForm');
    }
    public function loginUser(Request $request)
    {
        // Valider les données du formulaire de connexion
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tentative d'authentification de l'utilisateur
        if (Auth::attempt($credentials)) {
            // Authentification réussie
            return redirect()->intended('/'); // Rediriger vers la page d'accueil
        } else {
            // Authentification échouée
            return back()->withErrors(['email' => 'Les informations de connexion fournies sont incorrectes.'])->withInput();
        }
    }
}
