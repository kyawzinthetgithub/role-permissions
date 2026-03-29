<?php

namespace KyawZinThet\RolePermissions\Commands;

use Illuminate\Console\Command;
use KyawZinThet\RolePermissions\Models\Role;

class InstallRolesCommand extends Command
{
    protected $signature = 'install:role';
    protected $description = 'Install default roles (super-admin)';

    public function handle()
    {
        if (Role::where('slug', 'super-admin')->exists()) {
            $this->info('Super Admin role already exists.');
            return;
        }

        Role::updateOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin']
        );

        $this->info('Super Admin role installed successfully.');
    }
}
