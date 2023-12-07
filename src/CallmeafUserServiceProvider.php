<?php

namespace Callmeaf\User;

use Illuminate\Support\ServiceProvider;

class CallmeafUserServiceProvider extends ServiceProvider
{
    private const CONFIGS_DIR = __DIR__ . '/../config';
    private const ROUTES_DIR = __DIR__ . '/../routes';
    private const DATABASE_DIR = __DIR__ . '/../database';
    private const LANG_DIR = __DIR__ . '/../lang';
    private const LANG_NAMESPACE = 'callmeaf_user';
    public function boot()
    {
        $this->registerConfig();

        $this->registerRoute();

        $this->registerMigration();

        $this->registerLang();
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(self::CONFIGS_DIR . '/callmeaf-user.php','callmeaf-user.php');
        $this->publishes([
            self::CONFIGS_DIR . '/callmeaf-user.php' => config_path('callmeaf-user.php'),
        ]);
    }

    private function registerRoute(): void
    {
        $this->loadRoutesFrom(self::ROUTES_DIR . '/v1/api.php');
    }

    private function registerMigration(): void
    {
        $this->loadMigrationsFrom(self::DATABASE_DIR . '/migrations');
        $this->publishes([
            self::DATABASE_DIR . '/migrations' => database_path('migrations'),
        ],'callmeaf-user-migrations');
    }

    private function registerLang(): void
    {
        $langPathFromVendor = lang_path('vendor/callmeaf/user');
        if(is_dir($langPathFromVendor)) {
            $this->loadTranslationsFrom($langPathFromVendor,self::LANG_NAMESPACE);
        } else {
            $this->loadTranslationsFrom(self::LANG_DIR,self::LANG_NAMESPACE);
        }
        $this->publishes([
            self::LANG_DIR => $langPathFromVendor,
        ]);
    }
}
