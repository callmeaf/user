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
        \Callmeaf\User\Events\Stored::class => [
            \Callmeaf\User\Listeners\SendWelcomeMailToUser::class,
//            \Callmeaf\User\Listeners\SendWelcomeSmsToUser::class,
        ],
        \Callmeaf\User\Events\Updated::class => [
            // listeners
        ],
        \Callmeaf\User\Events\StatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\User\Events\Destroyed::class => [
            // listeners
        ],
        \Callmeaf\User\Events\Restored::class => [
            // listeners
        ],
        \Callmeaf\User\Events\ForceDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'index' => [
            'mobile' => false,
            'email' => false,
            'first_name' => false,
            'last_name' => false,
        ],
        'store' => [
            'status' => true,
            'type' => true,
            'mobile' => true,
            'email' => false,
            'first_name' => true,
            'last_name' => true,
            'national_code' => true,
        ],
        'show' => [

        ],
        'update' => [
            'status' => false,
            'type' => false,
            'email' => false,
            'first_name' => false,
            'last_name' => false,
            'national_code' => false,
        ],
        'status_update' => [
            'status' => true,
        ],
        'destroy' => [
            //
        ],
        'restore' => [
            //
        ],
        'trashed' => [
            //
        ],
        'force_destroy' => [
            //
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
    ],
    'controllers' => [
        'users' => \Callmeaf\User\Http\Controllers\V1\Api\UserController::class,
    ],
    'middlewares' => [
        'global' => [],
    ],
    'searcher' => \Callmeaf\User\Utilities\V1\Searcher::class,
];
