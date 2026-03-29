<?php

namespace KyawZinThet\RolePermissions\Commands;

use Illuminate\Console\Command;
use KyawZinThet\RolePermissions\Models\Permission;

class InstallPermissionsCommand extends Command
{
    protected $signature = 'install:permissions';
    protected $description = 'Install or update permissions from config file';

    public function handle()
    {
        $permissions = collect(config('permissions'))
            ->unique('slug')
            ->values();

        Permission::query()
            ->whereNotIn('slug', $permissions->pluck('slug'))
            ->delete();

        foreach ($permissions as $perm) {
            Permission::updateOrCreate(
                ['slug' => $perm['slug']],
                [
                    'name' => $perm['name'],
                    'create' => $perm['create'] ?? false,
                    'read' => $perm['read'] ?? false,
                    'update' => $perm['update'] ?? false,
                    'delete' => $perm['delete'] ?? false,
                ]
            );
        }

        $this->info('Permissions installed/updated successfully.');
    }
}
