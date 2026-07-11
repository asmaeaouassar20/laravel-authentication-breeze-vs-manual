<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


use \App\Http\Requests\LoginRequest;
class LoginController extends Controller
{

// un contrôleur invocable est celui qui ne gère qu'une seule action unique
    public function __invoke(LoginRequest $request) : RedirectResponse{

    // si la validation échoue, Laravel redirige automatiquement  l'utilisateur en arrière avec les erreurs
    // si l'utilisateur existe, Laravel compare le mdp fourni avec celui hashé dans la BD
         $credentials = $request->validated();

         // Auth::attempt() va chercher l'utilisateur dans la BD par son email
         if(Auth::attempt($credentials)){

         // Sécurité : si la connexion réussit, on régénère l'ID de la session
         // cela permet de prévenir les attaques par "fixation de session" (Session Fixation)
            $request->session()->regenerate();

            // On redirige l'utilisateur vers la page qu'il essayait d'atteindre 
            // avant d'être redirigé vers le login (intended), sinon par défaut vers le 'dashboard'.
            return redirect()->intended('dashboard');
         }

         // ÉCHEC DE CONNEXION : Si Auth::attempt() a renvoyé 'false' (mauvais email ou mot de passe),
         // on renvoie l'utilisateur sur la page précédente (le formulaire de login)... 
         return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
         ])->onlyInput('email');
         // onlyInput('email') => dire explicitement à Laravel : "Garde l'email pour lui éviter de le retaper, mais supprime définitivement le mot de passe de la mémoire."
    }
}
 