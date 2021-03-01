<?php

use App\User;

if (!function_exists('addUser')) {
    function addUser($name, $discordID, $tycoonID) {
        $user = User::where('discord_id', $discordID)->orWhere('tycoon_id', $tycoonID)->first();
        if ($user) abort(400, 'Conflicting identifier found');
        $user = new User([
            'name' => $name,
            'discord_id' => $discordID,
            'tycoon_id' => $tycoonID
        ]);
        $user->save();
    }
}

if (!function_exists('hireUser')) {
    function hireUser($userIdentifier) {
        $user = User::where('id', $userIdentifier)->orWhere('discord_id', $userIdentifier)->first();
        if (!$user) abort(404, 'User not found');
        $user->employee = true;
        $user->save();
    }
}

if (!function_exists('fireUser')) {
    function fireUser($userIdentifier) {
        $user = User::where('id', $userIdentifier)->orWhere('discord_id', $userIdentifier)->first();
        if (!$user) abort(404, 'User not found');
        $user->employee = $user->management = false;
        $user->save();
    }
}

if (!function_exists('promoteUser')) {
    function promoteUser($userIdentifier) {
        $user = User::where('id', $userIdentifier)->orWhere('discord_id', $userIdentifier)->first();
        if (!$user) abort(404, 'User not found');
        if ($user->trainee) {
            $user->trainee = false;
        }
        else {
            $user->management = true;
        }
        $user->save();
    }
}

if (!function_exists('demoteUser')) {
    function demoteUser($userIdentifier) {
        $user = User::where('id', $userIdentifier)->orWhere('discord_id', $userIdentifier)->first();
        if (!$user) abort(404, 'User not found');
        if ($user->management) {
            $user->management = false;
        }
        else {
            $user->trainee = true;
        }
        $user->save();
    }
}