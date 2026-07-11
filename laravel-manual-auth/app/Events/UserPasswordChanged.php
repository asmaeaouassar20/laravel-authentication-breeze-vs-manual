<?php

use App\Models\Utilisateur;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserpasswordChanged{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Utilisateur $user
    ){}
    
}

?>