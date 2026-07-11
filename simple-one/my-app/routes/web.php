<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


// login
Route::get('login' , [AuthController::class , 'login'])->name('login');
Route::post('login' , LoginController::class)
->middleware('throttle:3,1') // 'throttle:3,1' est le middleware de "Rate Limiting" (limitation du nombre de requêtes) [ (3) représente le NOMBRE MAXIMUM de tentatives autorisées.  -  (1) représente la PÉRIODE de temps en MINUTES.  ]
->name('login.attempt');

// register
Route::get('register' , [AuthController::class  , 'register'])->name('register');
Route::post('register' , RegisterController::class)->name('register.store');

// dashboard
Route::view('dashboard' ,'dashboard')->middleware(('auth'))->name('dashboard');
Route::view('dashboard2' ,'dashboard2')->name('dashboard2');

// logout
Route::post('logout' , [AuthController::class , 'logout'])->name('logout');
