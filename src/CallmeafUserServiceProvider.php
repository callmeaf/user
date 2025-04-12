<?php

namespace Callmeaf\User;

use Callmeaf\Base\CallmeafServiceProvider;
use Callmeaf\Base\Contracts\ServiceProvider\HasConfig;
use Callmeaf\Base\Contracts\ServiceProvider\HasEvent;
use Callmeaf\Base\Contracts\ServiceProvider\HasLang;
use Callmeaf\Base\Contracts\ServiceProvider\HasMigration;
use Callmeaf\Base\Contracts\ServiceProvider\HasRepo;
use Callmeaf\Base\Contracts\ServiceProvider\HasRoute;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;

class CallmeafUserServiceProvider extends CallmeafServiceProvider implements HasConfig, HasRepo, HasRoute, HasEvent, HasMigration, HasLang
{
    protected function serviceKey(): string
    {
        return 'user';
    }

    public function repo(): string
    {
        return UserRepoInterface::class;
    }

}
