<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function googlelogin() {
        return Socialite::driver('google')->redirect();
    }
    public function googleauthentication()
    {
        try{
            $googleUser=Socialite::driver('google')->user();
            $user = User::where('google_id',$googleUser->id)->first();
            if($user){
                Auth::login($user);
                return redirect()->route('home.index');
            }else{
                $userdata = User::create([
                    'name'=>$googleUser->name,
                    'email'=>$googleUser->email,
                    'password'=>Hash::make('Password@1234'),
                    'google_id'=>$googleUser->id
                ]);
                if($userdata){
                    Auth::login($userdata);
                    return redirect()->route('home.index');
                }
            }
        }catch(Exception $e){
            dd($e);
        }
    }
}
