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
    ],
    'resources' => [
    ],
    'collections' => [
        'index' => [
            'relations' => [],
            'columns' => [
                'id',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'mobile',
                'email',
                'first_name',
                'last_name',
                'full_name',
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
