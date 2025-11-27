<?php

namespace KyawZinThet\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use KyawZinThet\RolePermissions\Helpers\UserResolver;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions')
            ->withPivot(['create', 'read', 'update', 'delete'])
            ->withTimestamps();
    }

    public function users()
    {
        $userModel = UserResolver::model();
        return $this->belongsToMany($userModel, 'user_roles');
    }
}
