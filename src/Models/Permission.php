<?php

namespace KyawZinThet\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KyawZinThet\RolePermissions\Helpers\UserResolver;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'create', 'read', 'update', 'delete'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions')
            ->withPivot(['create', 'read', 'update', 'delete'])
            ->withTimestamps();
    }

    public function users()
    {
        $userModel = UserResolver::model();

        return $this->belongsToMany($userModel, 'user_permissions')
            ->withPivot(['create','read','update','delete'])
            ->withTimestamps();
    }
}
