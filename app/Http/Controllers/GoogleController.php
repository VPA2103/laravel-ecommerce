<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function authProviderRedirect($provider)
    {
        if ($provider) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }
    public function socialAuthentication($provider)
    {

        try {
            if ($provider) {

                $socialUser = Socialite::driver($provider)->user();

                $user = User::where('auth_provider_id', $socialUser->id)->first();

                if ($user) {
                    Auth::login($user);
                    return redirect()->route('home.index');
                } else {
                    $userdata = User::create([
                        'name' => $socialUser->name,
                        'email' => $socialUser->email,
                        'password' => Hash::make('Password@1234'),
                        'auth_provider_id' => $socialUser->id,
                        'auth_provider' => $provider,
                    ]);
                    if ($userdata) {
                        Auth::login($userdata);
                    }
                    return redirect()->route('home.index');
                }
            }
            abort(404);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
