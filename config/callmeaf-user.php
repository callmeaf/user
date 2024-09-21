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
        \Callmeaf\User\Events\UserIndexed::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserStored::class => [
            \Callmeaf\User\Listeners\SendWelcomeMailToUser::class,
//            \Callmeaf\User\Listeners\SendWelcomeSmsToUser::class,
        ],
        \Callmeaf\User\Events\UserShowed::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserUpdated::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserDestroyed::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserRestored::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserTrashed::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserForceDestroyed::class => [
            \Callmeaf\User\Listeners\DetachRolesPivotByUser::class,
        ],
        \Callmeaf\User\Events\UserSyncedRoles::class => [
            // listeners
        ],
        \Callmeaf\User\Events\UserProfileImageUpdated::class => [
            // listeners
        ],
    ],
    'validations' => [
        'user' => \Callmeaf\User\Utilities\V1\Api\User\UserFormRequestValidator::class,

    ],
    'resources' => [
       'user' => \Callmeaf\User\Utilities\V1\Api\User\UserResources::class,
    ],
    'controllers' => [
        'users' => \Callmeaf\User\Http\Controllers\V1\Api\UserController::class,
    ],
    'form_request_authorizers' => [
        'user' => \Callmeaf\User\Utilities\V1\Api\User\UserFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'user' => \Callmeaf\User\Utilities\V1\Api\User\UserControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\User\Utilities\V1\Api\User\UserSearcher::class,
    'seeders' => [
        \Callmeaf\User\Seeders\UserSeeder::class,
    ],
];
