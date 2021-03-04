<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    function redirect() {
        return Auth::check() ? back() : Socialite::driver('discord')->setScopes(['identify'])->redirect();
    }

    function callback() {
        $discordUser = Socialite::driver('discord')->stateless()->user();
        $user = User::where('discord_id', $discordUser->id)->first();

        if (!$user) {
            $user = User::create([
                'name' => $discordUser->name,
                'discord_id' => $discordUser->id,
            ]);
        }

        Auth::login($user);
        return redirect()->intended('/profile');
    }

    function logout() {
        Auth::logout();
        return redirect('');
    }
}
