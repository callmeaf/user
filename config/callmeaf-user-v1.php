<?php

use Callmeaf\Base\App\Enums\RequestType;

return [
    'model' => \App\Models\User::class,
    'route_key_name' => 'email',
    'repo' => \Callmeaf\User\App\Repo\V1\UserRepo::class,
    'resources' => [
        RequestType::API->value => [
            'resource' => \Callmeaf\User\App\Http\Resources\Api\V1\UserResource::class,
            'resource_collection' => \Callmeaf\User\App\Http\Resources\Api\V1\UserCollection::class,
        ],
        RequestType::WEB->value => [
            'resource' => \Callmeaf\User\App\Http\Resources\Web\V1\UserResource::class,
            'resource_collection' => \Callmeaf\User\App\Http\Resources\Web\V1\UserCollection::class,
        ],
        RequestType::ADMIN->value => [
            'resource' => \Callmeaf\User\App\Http\Resources\Admin\V1\UserResource::class,
            'resource_collection' => \Callmeaf\User\App\Http\Resources\Admin\V1\UserCollection::class,
        ],
    ],
    'events' => [
        RequestType::API->value => [
            \Callmeaf\User\App\Events\Api\V1\UserIndexed::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Api\V1\UserCreated::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Api\V1\UserShowed::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Api\V1\UserUpdated::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Api\V1\UserDeleted::class => [
                // listeners
            ],
        ],
        RequestType::WEB->value => [
            \Callmeaf\User\App\Events\Web\V1\UserIndexed::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Web\V1\UserCreated::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Web\V1\UserShowed::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Web\V1\UserUpdated::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Web\V1\UserDeleted::class => [
                // listeners
            ],
        ],
        RequestType::ADMIN->value => [
            \Callmeaf\User\App\Events\Admin\V1\UserIndexed::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Admin\V1\UserCreated::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Admin\V1\UserShowed::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Admin\V1\UserUpdated::class => [
                // listeners
            ],
            \Callmeaf\User\App\Events\Admin\V1\UserDeleted::class => [
                // listeners
            ],
        ],
    ],
    'requests' => [
        RequestType::API->value => [
            'index' => \Callmeaf\User\App\Http\Requests\Api\V1\UserIndexRequest::class,
            'store' => \Callmeaf\User\App\Http\Requests\Api\V1\UserStoreRequest::class,
            'show' => \Callmeaf\User\App\Http\Requests\Api\V1\UserShowRequest::class,
            'update' => \Callmeaf\User\App\Http\Requests\Api\V1\UserUpdateRequest::class,
            'destroy' => \Callmeaf\User\App\Http\Requests\Api\V1\UserDestroyRequest::class,
        ],
        RequestType::WEB->value => [
            'index' => \Callmeaf\User\App\Http\Requests\Web\V1\UserIndexRequest::class,
            'create' => \Callmeaf\User\App\Http\Requests\Web\V1\UserCreateRequest::class,
            'store' => \Callmeaf\User\App\Http\Requests\Web\V1\UserStoreRequest::class,
            'show' => \Callmeaf\User\App\Http\Requests\Web\V1\UserShowRequest::class,
            'edit' => \Callmeaf\User\App\Http\Requests\Web\V1\UserEditRequest::class,
            'update' => \Callmeaf\User\App\Http\Requests\Web\V1\UserUpdateRequest::class,
            'destroy' => \Callmeaf\User\App\Http\Requests\Web\V1\UserDestroyRequest::class,
        ],
        RequestType::ADMIN->value => [
            'index' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserIndexRequest::class,
            'store' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserStoreRequest::class,
            'show' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserShowRequest::class,
            'update' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserUpdateRequest::class,
            'destroy' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserDestroyRequest::class,
            'restore' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserRestoreRequest::class,
            'trashed' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserTrashedRequest::class,
            'forceDestroy' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserForceDestroyRequest::class,
            'updatePassword' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserUpdatePasswordRequest::class,
            'updateStatus' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserUpdateStatusRequest::class,
            'updateType' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserUpdateTypeRequest::class,
            'export' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserExportRequest::class,
            'import' => \Callmeaf\User\App\Http\Requests\Admin\V1\UserImportRequest::class,
        ],
    ],
    'controllers' => [
        RequestType::API->value => [
            'user' => \Callmeaf\User\App\Http\Controllers\Api\V1\UserController::class,
        ],
        RequestType::WEB->value => [
            'user' => \Callmeaf\User\App\Http\Controllers\Web\V1\UserController::class,
        ],
        RequestType::ADMIN->value => [
            'user' => \Callmeaf\User\App\Http\Controllers\Admin\V1\UserController::class,
        ],
    ],
    'routes' => [
        RequestType::API->value => [
            'prefix' => 'users',
            'as' => 'users.',
            'middleware' => [],
        ],
        RequestType::WEB->value => [
            'prefix' => 'users',
            'as' => 'users.',
            'middleware' => [],
        ],
        RequestType::ADMIN->value => [
            'prefix' => 'users',
            'as' => 'users.',
            'middleware' => [],
        ],
    ],
    'enums' => [
        'status' => \Callmeaf\User\App\Enums\UserStatus::class,
        'type' => \Callmeaf\User\App\Enums\UserType::class,
    ],
    'exports' => [
        RequestType::API->value => [
            'excel' => null,
        ],
        RequestType::WEB->value => [
            'excel' => null,
        ],
        RequestType::ADMIN->value => [
            'excel' => \Callmeaf\User\App\Exports\Admin\V1\UsersExport::class,
        ],
    ],
    'imports' => [
        RequestType::API->value => [
            'excel' => null,
        ],
        RequestType::WEB->value => [
            'excel' => null,
        ],
        RequestType::ADMIN->value => [
            'excel' => \Callmeaf\User\App\Imports\Admin\V1\UsersImport::class,
        ],
    ],
];
