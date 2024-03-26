<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    public function loginAdmin(Request $request)
    {
        // Valider les données du formulaire de connexion
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tentative d'authentification de l'utilisateur
        if (Auth::attempt($credentials)) {
            // Vérifier le profil de l'utilisateur
            $user = Auth::user();
            if ($user->profile_type === 'admin') {
                // Rediriger vers le tableau de bord administrateur
                return redirect()->route('admin.dashboard');
            }
        } else {
            // Authentification échouée
            return back()->withErrors(['email' => 'Les informations de connexion fournies sont incorrectes.'])->withInput();
        }
    }


    public function index()
    {
        // Nombre d'utilisateurs avec le profil "teacher"
        $teacherCount = User::where('profile_type', 'teacher')->count();

        // Somme totale des heures pour tous les utilisateurs
        $totalHours = DB::table('users')->sum('schedule');

        // Fetch des enseignants
        $teachers = User::where('profile_type', 'teacher')->get();

        // Transmettre les variables à la vue
        return view('admin.dashboard', compact('teachers', 'teacherCount', 'totalHours'));
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        $userData = "Nom: {$user->last_name}\nPrénom: {$user->first_name}\nEmail: {$user->email}\nTéléphone: {$user->phone}\nCNI: {$user->cni}\nProfil: {$user->profile_type}\nHoraires: {$user->schedule}\nMontant: {$user->amount}\n";
        $qrCode = QrCode::size(350)->generate($userData);
        return view('admin.show', compact('user', 'qrCode'));
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function generateSalairePDF($id)
    {
        $user = User::findOrFail($id);

        // Récupérer le salaire horaire de l'utilisateur depuis la base de données
        $salaireHoraire = $user->amount; // Supposons que le montant dans la colonne 'amount' représente le salaire horaire

        // Calculer le salaire total en multipliant le salaire horaire par le nombre d'heures travaillées (schedule)
        $salaireTotal = $salaireHoraire * $user->schedule;

        // Générer les données pour le bulletin de salaire
        $userData = [
            'user' => $user,
            'salaireTotal' => $salaireTotal,
        ];

        // Créer une instance de Dompdf
        $dompdf = new Dompdf();

        // Charger la vue du bulletin de salaire
        $html = view('admin.salaire_pdf', $userData)->render();

        // Charger le contenu HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Rendre le PDF
        $dompdf->render();

        // Générer le nom du fichier PDF
        $fileName = 'bulletin_salaire_' . $user->last_name . '_' . $user->first_name . '.pdf';

        // Télécharger le PDF avec le nom de fichier spécifié
        return $dompdf->stream($fileName);
    }


}
