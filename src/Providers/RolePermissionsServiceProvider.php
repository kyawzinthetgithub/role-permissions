<?php

namespace KyawZinThet\RolePermissions\Providers;

use Illuminate\Support\ServiceProvider;
use KyawZinThet\RolePermissions\Commands\InstallRolesCommand;
use KyawZinThet\RolePermissions\Commands\InstallPermissionsCommand;

class RolePermissionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/permissions.php', 'permissions');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/permissions.php' => config_path('permissions.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallRolesCommand::class,
                InstallPermissionsCommand::class,
            ]);
        }
    }
}
