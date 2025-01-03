<?php

namespace Callmeaf\User\Utilities\V1\Api\User;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class UserControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(): array
    {
        return [
            new Middleware(middleware: 'auth:sanctum',only: [
                'index',
                'store',
                'show',
                'update',
                'statusUpdate',
                'destroy',
                'trashed',
                'restore',
                'forceDestroy',
                'syncRoles',
                'profileImageUpdate'
            ])
        ];
    }
}
