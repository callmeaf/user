<?php

namespace Callmeaf\User\Utilities\V1;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class UserFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return userCan(PermissionName::USER_INDEX);
    }

    public function create(): bool
    {
        return userCan(PermissionName::USER_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::USER_STORE);
    }

    public function show(): bool
    {
        return userCan(PermissionName::USER_SHOW);
    }

    public function edit(): bool
    {
        return userCan(PermissionName::USER_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::USER_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::USER_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::USER_DESTROY);
    }

    public function trashed(): bool
    {
        return userCan(PermissionName::USER_TRASHED);
    }

    public function restore(): bool
    {
        return userCan(PermissionName::USER_RESTORE);
    }

    public function forceDestroy(): bool
    {
        return userCan(PermissionName::USER_FORCE_DESTROY);
    }
    public function syncRoles(): bool
    {
        return userCan(PermissionName::USER_UPDATE);
    }

    public function profileImageUpdate(): bool
    {
        return userCan(PermissionName::USER_UPDATE);
    }
}
