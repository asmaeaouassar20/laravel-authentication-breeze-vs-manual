<?php

namespace App\Http\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required' , 'string' , 'email' , 'max:255'],
            'password' => ['required' ,'string' , 'min:8'],
            'remember' => ['boolean']
        ];
    }

    public function messages():array {
        return [
            'email.required' => 'Email est obligatoire',
            'email.email' => 'Veuillez fournir une adresse email valide',
            'password.required' => 'le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères'
        ];
    }



    public function authentificate() :void {
        
        // SECURTIE : vérifier si l'IP ou email n'a pas dépasse le nombre de tentatives autorisées
        $this->ensureIsNotRateLimited();

        // si la tentative de connexion échoue on ajoute 1 au compteur de mauvaise tenattaives pour cet utilisateur
        if(!auth()->attempt($this->only('email' , 'password') , $this->boolean('remember'))){
              RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
        }    

         // si le mdp est bon mais le compte n'est pas actif on déconnecte
            if(!auth()->user()->is_active){
                 auth()->logout();
                 throw ValidationException::withMessages([
                    'email' => 'votre compte a été désactivé. Veuillez contacter admin'
                 ]);
            }

            // si tout est bon on enregistre l'heure et ip de la connexion
            auth()->User()->recordLogin();

            // initialiser le compteur
            RateLimiter::clear($this->throttleKey());
    }


    // Rate limiting
    public function ensureisNotRateLimited() : void {
        if(!RateLimiter::tooManyAttempts($this->throttleKey(),5)){
            return;
        }

        // si 5 essais sont dépassés, on déclenche un événement Lockout
        event(new Lockout($this));

        // on calcule combien deseconds il reste avant qu'il puisse réessayer
        $seconds = RateLimiter::availableIn($this->throttleKey());

        // on bloque la requete est on affiche msg
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle' , [
                'seconds' => $seconds,
                'minutes' => ceil($seconds/60),
            ]),
        ]);
    }


    // générer une clé unique pour suivre les tentatives de connexion.  Cette clé est basée sur l'email en minutes et l'adresse IP
    public function throttleKey() : string {
       return Str::transliterate((Str::lower($this->string('email')).'|'.$this->ip()));
    }
   
}
