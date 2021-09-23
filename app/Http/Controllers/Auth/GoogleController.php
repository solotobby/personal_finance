<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Socialite;

use Exception;


class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            //incase the email already exist...we just update the google_id and avarta
            $googleUser = User::where('email', $user->email)->first();
            if($googleUser){
                $googleUser->google_id = $user->id;
                $googleUser->avarta_url = $user->avatar;
                $googleUser->save();
                Auth::login($googleUser);
                return redirect('/dashboard');
            }

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/dashboard');
            }else{
                $password = Str::random(9);
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'avarta_url'=> $user->avatar,
                    'password' => Hash::make($password),//encrypt('123456dummy')
                ]);
                Auth::login($newUser);
                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
