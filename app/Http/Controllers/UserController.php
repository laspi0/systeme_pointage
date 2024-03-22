<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showForm()
    {
        return view('users.register');
    }
    public function createUser(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'cni' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        // Créer un nouvel utilisateur avec les valeurs par défaut
        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'phone' => $request->phone,
            'cni' => $request->cni,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_type' => 'teacher', // Profil par défaut
            'schedule' => 0, // Valeur par défaut pour l'horaire
            'amount' => 5000, // Valeur par défaut pour le montant
        ]);

        // Redirection après l'inscription
        return redirect()->route('/')->with('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
    }
}
