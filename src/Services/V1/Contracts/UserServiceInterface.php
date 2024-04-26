<?php

namespace Callmeaf\User\Services\V1\Contracts;

use Callmeaf\Base\Services\V1\Contracts\BaseServiceInterface;
use Callmeaf\Permission\Models\Role;
use Callmeaf\User\Services\V1\UserService;

interface UserServiceInterface extends BaseServiceInterface
{
    public function syncRoles(null|string|int|iterable|Role $roles = []): UserService;

}
