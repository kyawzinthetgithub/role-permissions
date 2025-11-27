<?php

namespace KyawZinThet\RolePermissions\Helpers;
use Illuminate\Support\Facades\Config;

class UserResolver
{
    public static function model()
    {
        return Config::get('auth.providers.users.model', \App\Models\User::class);
    }
}