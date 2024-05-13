<?php

namespace Callmeaf\User\Utilities\V1\User\Api;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;


class UserControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(BaseController $controller): void
    {
        $controller->middleware('auth:sanctum')->only([
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
        ]);
    }
}
