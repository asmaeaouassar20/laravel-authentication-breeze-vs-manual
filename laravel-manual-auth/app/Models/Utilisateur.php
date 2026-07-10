<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{

// attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'role',
        'last_login_at',
        'last_login_ip',
        'email_verified_at',
        'is_active'
    ];




    /*

    The attributes that should be hidden for serialization

      * C'est dire à Laravel Lorsque tu convertis ce modèle en tableau ou en JSON, n'inclus pas ces attributs. 
      * Les champs existent toujours en base de données et dans l'objet PHP, mais ils sont cachés lors de la sérialisation.
      * Même si le mot de passe est haché, il ne doit jamais être envoyé au client.

    */
    protected $hidden = [
       'password',
       'remember_token'
    ];


    // The attributes that shoud be cast
    protected function casts() : array {
        return [
           'email_verified_at' => 'datetime',
           'last_login_at' => 'datetime',
           'password' => 'hashed',
           'is_active' => 'boolean',
           'role' => UserRole::class
        ];
    }



    // get the user's profiel photo URL
    public function getPhotoUrl() : string {
        if($this->profile_photo_path){
            return asset('storage'.$this->profile_photo_path);
        }
         return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }



    // Record user login infrmation

    public function recordLogin(){
       $this->update([
        'last_login_at' => now(),
        'last_login_ip' => request()->ip()
       ]);
    }




    // check if user is admin
    public function isAdmin():bool{
        return $this->role === UserRole::Admin;
    }
}
