<?php 

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;


class NewDeviceLogin extends Notification{
    use Queueable;

    public function via(object $notificable) :array{
        return ['mail','database'];
    }

    public function toMail(){
        // todo
    }
}

?>