<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(private readonly AuthService $auth_service){
       $this->middleware('guest');
    }



    // show registration form
    public function create() : View{
        return view('auth.registe');
    }



    // handle a registration request
    public function store(RegisterRequest $request) : RedirectResponse{
        $user = ^this->authService->register($request->validated());

        $request->session()->regenerate();

        return redirect()
        ->route('verification.notice')
        ->with('success' , 'Votre compte a été créé avec succès! Veuillez vérifer votre email');
    }
}
