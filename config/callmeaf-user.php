<?php

return [
    'model' => \Callmeaf\User\Models\User::class,
    'model_resource' => \Callmeaf\User\Http\Resources\V1\Api\UserResource::class,
    'model_resource_collection' => \Callmeaf\User\Http\Resources\V1\Api\UserCollection::class,
    'service' => \Callmeaf\User\Services\V1\UserService::class,
    'default_values' => [
        'status' => \Callmeaf\User\Enums\UserStatus::ACTIVE,
        'type' => \Callmeaf\User\Enums\UserType::NORMAL,
    ],
    'events' => [
    ],
    'validations' => [
        'index' => [
            'mobile' => false,
            'email' => false,
            'first_name' => false,
            'last_name' => false,
        ],
        'show' => [

        ],
    ],
    'resources' => [
        'index' => [
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
                'created_at_text',
                'updated_at_text',
            ],
        ],
        'show' => [
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
        ],
    ],
    'controllers' => [
        'users' => \Callmeaf\User\Http\Controllers\V1\Api\UserController::class,
    ],
    'middlewares' => [
        'global' => [],
    ],
    'searcher' => \Callmeaf\User\Utilities\V1\Searcher::class,
];
