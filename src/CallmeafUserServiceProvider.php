<?php

namespace Callmeaf\User;

use Illuminate\Support\ServiceProvider;

class CallmeafUserServiceProvider extends ServiceProvider
{
    private const CONFIGS_DIR = __DIR__ . '/../config';
    private const CONFIGS_KEY = 'callmeaf-user';
    private const CONFIGS_GROUP = 'callmeaf-user-config';
    private const ROUTES_DIR = __DIR__ . '/../routes';
    private const DATABASE_DIR = __DIR__ . '/../database';
    private const DATABASE_GROUPS = 'callmeaf-user-migrations';
    private const LANG_DIR = __DIR__ . '/../lang';
    private const LANG_NAMESPACE = 'callmeaf_user';
    private const LANG_GROUP = 'callmeaf-user-lang';
    public function boot()
    {
        $this->registerConfig();

        $this->registerRoute();

        $this->registerMigration();

        $this->registerLang();
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(self::CONFIGS_DIR . '/callmeaf-user.php',self::CONFIGS_KEY);
        $this->publishes([
            self::CONFIGS_DIR . '/callmeaf-user.php' => config_path('callmeaf-user.php'),
        ],self::CONFIGS_GROUP);
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
        ],self::DATABASE_GROUPS);
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
        ],self::LANG_GROUP);
    }
}
