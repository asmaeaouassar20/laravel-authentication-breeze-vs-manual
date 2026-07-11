<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(private readonly AUthServoce $authService){
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }



    // show the login form
    public function create():View{
        return view('auth.login');
    }



    // handle Authentication attempt
    public function store(LoginRequest $request) : RedirectResponse{
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard' , absolute:false))
        ->with('success' , 'Bienvenue! vous êtes connecté');
    }



    // log the user out
    public function logout(request $request):RedirecTResponse{
           auth()->logout();
           $request->session()->invalidate();
           $request->session()->regenerateToken();

           retur redirect()
           ->Route()
           ->with('success' , 'Vous avez été déconnecté avec succès');
    }
}
