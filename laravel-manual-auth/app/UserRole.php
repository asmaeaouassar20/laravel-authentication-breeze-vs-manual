<?php

namespace App;

enum UserRole : string
{
    case User = 'user';
    case Admin = 'admin';


    // pour retourner un nom visible
    public function label() : string {
        return match($this){
            self::User => 'Utilisateur',
            self::Admin  => 'Administrateur'
        };
    }


    // pour retourner une couleur associée
    public function color() :string {
        return match($this){
            self::User => 'blue',
            self::Admin => 'purple'
        };
    }
}
