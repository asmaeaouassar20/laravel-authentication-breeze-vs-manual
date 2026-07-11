<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('login');
    }
     public function register(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('register');
    }


    public function logout(){

    // On déconnecte l'utilisateur du guard 'web' (la session standard). On peut remplacer par : Auth::logout(); si on n'a pas une Multi-authentification
    // Cela supprime les informations d'authentification de l'utilisateur pour la requête actuelle
    Auth::guard('web')->logout();

    // On efface toutes les données stockées dans la session actuelle
    Session::invalidate();

    // On régénère le jeton CSRF (Cross-Site Request Forgery).
    // pour empêcher les attaques malveillantes qui tenteraient de réutiliser
    // l'ancien jeton maintenant que l'utilisateur est déconnecté.
    Session::regenerateToken();

    return redirect('/');
}
}
