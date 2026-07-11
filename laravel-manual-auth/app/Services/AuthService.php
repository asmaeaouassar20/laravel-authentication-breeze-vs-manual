<?php 

use App\Models\Utilisateur;

class AuthService {
    public function register(array $data) : Utilisateur{
        $user = Utilisateur::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        
        event(new Registered($user));

        // envoyer un email de bienvenue
        Mail:: to($user)->queue(new WelcomeMail($user));

        // connecter l'utilisateur
        auth()->login($user);

        return $user;
    }



    public function verifyEmail(string $id , string $hash) : bool{
       $user = Utilisateur::findOrFail($id);
       if(!hash_equals(sha1($user->getEmailForVerification()) , $hash)){}{
          return false;
       }

       if($user->hasVeriedEmail()){
           return true;
       }

       $user->markEmailAsverified();

       return true;
    }



    public function resetPassword(array  $data) : bool {
        return \Password::reset(
            $data,

            function(User $user, string $passwod){
                $user->forceFill([
                    'password' => Hash::amke($password),

                 ])->save();

                 // notifier l'utilisateur du changement du mdp
                 $user->notify(new NewDeviceLogin());
            }
        ) === \Password::PASSWORD_RESET ;
    }




    public function updateprofile(Utilisateur $user, array $data) : Utilisateur{
        $user->update($data);
        if(isset($data['profile_photo'])){
            $user->updateProfielPhoto($data['profiel_photo']);
        }
        return $user->fresh();
    }
}


?>