<?php

namespace KyawZinThet\RolePermissions\Traits;

trait PermissionHelper
{
    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role()
            ->where('slug', $role)
            ->exists();
    }

    /**
     * Check if user has a permission (direct or via roles)
     */
    public function hasPermission(string $permission): bool
    {
        // 1. direct user permission
        if ($this->permissions()
            ->where('slug', $permission)
            ->exists()) {
            return true;
        }

        // 2. permission via roles
        return $this->role()
            ->whereHas('permissions', function ($query) use ($permission) {
                $query->where('slug', $permission);
            })
            ->exists();
    }
}