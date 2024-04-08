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

        ],
    ],
    'resources' => [
    ],
    'controllers' => [
        'users' => \Callmeaf\User\Http\Controllers\V1\Api\UserController::class,
    ],
    'middlewares' => [
        'global' => [],
    ],
    'searchable_columns' => [

    ],
];
