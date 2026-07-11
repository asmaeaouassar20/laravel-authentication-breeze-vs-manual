<?php

use Illuminate\Support\Facades\Route;



// Guest Routes
Route::middleware('guest')->group(function(){

// Login
Route::get('/login' , [LoginController::class , 'create'])->name('login');
Route::post('/login' , [LoginController::class ,'store']);

// Register
Route::get('/register' , [RegisterController::class , 'create'])->name('register');
Route::post('/register' , [registerController::class , 'store']);

// Password reset
Route::get('/forget-password' , [PasswordResetController::class , 'create'])
->name('password.request');
Route::post('/forgot-password' , [PasswordResetController::class , 'store'])
->name('password.email');
Route::get('/reset-password/{token}' , [PasswordResetController::class , 'showResetForm'])
->name('password.reset');
Route::post('/reset-password' , [PasswordResetController::class , 'update'])
->name('password.update');

});



// Authenticated Routes
Route::middleware('auth')->group(function(){
    //dashboard
    Route::get('/dashboard' ,  DashboardController::class)->name('dashboard');

    // logout
    Route::post('/logout' , [LoginController::class , 'logout'])->name('logout');

    // email verification
    Route::controller(EmailverificationController::class)->group(function(){
        Route::get('/email/verify' , 'notice')->name('verfiication.notice');
        Route::get('/email/verify{id}/{hash}' ,'verify')
        ->middleware('signed')
        ->name('verification.verify');
        Route::post(':email/verification-notification' ,'send')
        ->middleware('throttle:6,1')
        ->name('verification.send');        
    });

    // Profiel (requires verified email    )
    Route::middleware('verified')->group(function(){
        Route::get('/profile' , [ProfileController::class , 'edit'])->name('profile.edit');
        Route::put('/profile' , [ProfileController::class , 'update'] )->name('profile.update');
        Route::put('/profile/password' , [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
        Route::delete('/profile/photo' , [profileController::class , 'destroyPhoto'])
        ->name('profile.photo.destroy');
    });
});


// home page 
Route::get('/' , function(){
    return view('welcome');
})->name('home');