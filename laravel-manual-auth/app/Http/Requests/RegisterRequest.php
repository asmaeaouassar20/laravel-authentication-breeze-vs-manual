<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required' , 'string' ,'max:255' , 'regex:/^[a-zA-ZÀ-ÿ\s\-]+$/'], // expresseion régulière valide une chaîne contenant uniquement des lettres (y compris accentuées), des espaces et des tirets.
            'email' => ['required' , 'string' , 'email' ,'max:255' , 'unique:users,email'],
            'password' => ['required' ,'string' ,'confirmed' , Password::defaults()  ],
            'terms' => ['required' ,'accepted'],
        ];
    }




    public function messages() : array{
        return [
            'name.required' => 'Le nom est obligatoire',
            'name.regex' => 'Le nom ne doit contenire que des lettres et des espaces',
            'email.unique' => 'Cette adressse email est déjà utilisée',
            'password.confirmed' => 'La confirmation du mdp ne correspond pas',
            'terms.accepted' => 'Vous devez accepter les conditon d\'utilisation'
        ];
    }


    protected   function prepareForValidation() : void {
        $this->merge([
           'email' => strtolower($this->email),
           'name' => trim($this->name),
        ]);
    }
}
