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
        'user' => \Callmeaf\User\Utilities\V1\User\Api\UserFormRequestValidator::class,

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
        'store' => [
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
        'update' => [
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
        'status_update' => [
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
        'destroy' => [
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
        ],
        'restore' => [
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
        ],
        'trashed' => [
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
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
            ],
        ],
        'force_destroy' => [
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
        ],
        'sync_roles' => [
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
        'profile_image_update' => [
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
        ],
    ],
    'controllers' => [
        'users' => \Callmeaf\User\Http\Controllers\V1\Api\UserController::class,
    ],
    'form_request_authorizers' => [
        'user' => \Callmeaf\User\Utilities\V1\User\Api\UserFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'user' => \Callmeaf\User\Utilities\V1\User\Api\UserControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\User\Utilities\V1\User\Api\UserSearcher::class,
    'seeders' => [
        \Callmeaf\User\Seeders\UserSeeder::class,
    ],
];
