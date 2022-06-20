<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectfacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectgoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function signinFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->stateless()->user();
            $userCol = User::where('fb_id', $user->id)->first();

            if($userCol){
                Auth::login($userCol);
                return redirect()->route('admin.index');
            }else{
                $addUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt(Str::random(12))
                ]);

                Auth::login($addUser);
                return redirect()->route('admin.index');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function signinGoogle()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $userCol = User::where('google_id', $user->id)->first();

            if($userCol){
                Auth::login($userCol);
                return redirect()->route('admin.index');
            }else{
                $addUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt(Str::random(12))
                ]);

                Auth::login($addUser);
                return redirect()->route('admin.index');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
}
}
