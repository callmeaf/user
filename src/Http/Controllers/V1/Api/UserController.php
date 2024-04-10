<?php

namespace Callmeaf\User\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\User\Http\Requests\V1\Api\UserIndexRequest;
use Callmeaf\User\Services\V1\UserService;
use Illuminate\Support\Facades\Log;

class UserController extends ApiController
{
    protected UserService $userService;
    public function __construct()
    {
        $this->userService = app(config('callmeaf-user.service'));
    }

    public function index(UserIndexRequest $request)
    {
        try {
            $users = $this->userService->all(
                relations: config('callmeaf-user.collections.index.relations'),
                columns: config('callmeaf-user.collections.index.columns'),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-user.collections.index.attributes'));
             return apiResponse([
                 'users' => $users,
             ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}
