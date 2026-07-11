<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasProfilePhoto
{
    public function updateProfilePhoto(UploadedFile $photo) : void{
           tap($this->profile_photo_path, function($previous) use ($photo){
                 $this->forceFill([
                    'profile_photo_path' => $photo->storePublicly(
                        'profile-photos' , ['disk' => 'public']
                    )
                 ])->save();

                 if($previous){
                    Storage::disk('public')->delete($previous);
                 }
           });
    }



    public function deleteProfilePhoto():void{
        if(is_null($this->profile_photo_path)){
            return;
        }
        Storage::disk('public')->delete($this->profile_photo_path);
        $this->forceFill([
            'profiel_photo_path' => null
        ])->save();
    }
}


?>