<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userData = $request->validate([
            'name' => ['required' , 'string' , 'max:255'],
            'email' => ['required' , 'email' , 'unique:users'],
            'password' => ['required' , 'min:6' , 'confirmed' ]
        ]);
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        Mail::to($user->email)->send(new WelcomeEmail($user));
        Auth::login($user);
        return redirect()->route('dashboard');
    }
}
 