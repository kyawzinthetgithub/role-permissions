<?php

namespace KyawZinThet\RolePermissions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
