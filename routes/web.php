<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/redirectUser', [App\Http\Controllers\HomeController::class, 'redirect'])->name('redirect');

Route::get('/notifications' , [HomeController::class , 'showAll'])->name('all-notify');
Route::get('/show-notification/{id}' , [HomeController::class , 'show'])->name('one-notify');

//login facebook
Route::get('auth/facebook',[SocialController::class,'redirectfacebook'])->name('facebook');
Route::get('auth/facebook/callback',[SocialController::class,'signinFacebook']);
//login google
Route::get('auth/google',[SocialController::class,'redirectgoogle'])->name('google');
Route::get('auth/google/callback',[SocialController::class,'signinGoogle']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
