<?php

namespace Callmeaf\User\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\User\Http\Requests\V1\Api\UserIndexRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserShowRequest;
use Callmeaf\User\Models\User;
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
                relations: config('callmeaf-user.resources.index.relations'),
                columns: config('callmeaf-user.resources.index.columns'),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-user.resources.index.attributes'));
             return apiResponse([
                 'users' => $users,
             ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(UserShowRequest $request,User $user)
    {
        try {
            $user = $this->userService->setModel($user)->getModel(asResource: true,attributes: config('callmeaf-user.resources.show.attributes'),relations: config('callmeaf-user.resources.show.relations'));
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}
