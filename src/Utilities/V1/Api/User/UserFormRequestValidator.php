<?php

namespace Callmeaf\User\Utilities\V1\Api\User;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class UserFormRequestValidator extends FormRequestValidator
{
    public function index(): array
    {
        return [
            'mobile' => false,
            'email' => false,
            'first_name' => false,
            'last_name' => false,
        ];
    }

    public function store(): array
    {
        return [
            'status' => true,
            'type' => true,
            'mobile' => true,
            'email' => false,
            'first_name' => true,
            'last_name' => true,
            'national_code' => true,
        ];
    }

    public function show(): array
    {
        return [];
    }

    public function update(): array
    {
        return [
            'status' => true,
            'type' => true,
            'mobile' => true,
            'email' => false,
            'first_name' => true,
            'last_name' => true,
            'national_code' => true,
        ];
    }
    public function statusUpdate(): array
    {
        return [
            'status' => true,
        ];
    }

    public function destroy(): array
    {
        return [];
    }

    public function restore(): array
    {
        return [];
    }

    public function trashed(): array
    {
        return [
            'mobile' => false,
            'email' => false,
            'first_name' => false,
            'last_name' => false,
        ];
    }

    public function forceDestroy(): array
    {
        return [];
    }

    public function syncRoles(): array
    {
        return [
            'roles_ids' => false,
            'roles_ids.*' => true,
        ];
    }

    public function profileImageUpdate(): array
    {
        return [
            'image' => true,
        ];
    }
}
