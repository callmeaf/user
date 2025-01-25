<?php

namespace Callmeaf\User\Utilities\V1\Api\User;

use Callmeaf\Base\Utilities\V1\Resources;

class UserResources extends Resources
{
    public function index(): self
    {
        $this->data = [
            'relations' => [],
            'columns' => [
                'id',
                'type',
                'status',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'full_name',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function store(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function show(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function update(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function statusUpdate(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function destroy(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
            ],
        ];
        return $this;
    }

    public function restore(): Resources
    {
        $this->data = [
            'id_column' => 'id',
            'columns' => [
                'id',
                'type',
                'status',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at',
                'updated_at',
            ],
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function trashed(): Resources
    {
        $this->data = [
            'relations' => [],
            'columns' => [
                'id',
                'type',
                'status',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'full_name',
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
            ],
        ];
        return $this;
    }

    public function forceDestroy(): Resources
    {
        $this->data = [
            'id_column' => 'id',
            'columns' => [
                'id',
                'first_name',
                'last_name',
            ],
            'relations' => [],
            'attributes' => [
                'id',
            ],
        ];
        return $this;
    }

    public function syncRoles(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'type',
                'type_text',
                'status',
                'status_text',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'national_code',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }

    public function profileImageUpdate(): self
    {
        $this->data = [
            'relations' => [],
            'attributes' => [
                'id',
                'status',
                'status_text',
                'type',
                'type_text',
                'first_name',
                'last_name',
                'full_name',
                'mobile',
                'email',
                'email_verified_at',
                'national_code',
                'image',
                '!image' => [
                    'id',
                    'url'
                ],
            ],
        ];
        return $this;
    }
}
