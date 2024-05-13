<?php

namespace Callmeaf\User\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Media\Enums\MediaCollection;
use Callmeaf\Media\Enums\MediaDisk;
use Callmeaf\User\Events\UserDestroyed;
use Callmeaf\User\Events\UserForceDestroyed;
use Callmeaf\User\Events\UserRestored;
use Callmeaf\User\Events\UserStored;
use Callmeaf\User\Events\UserUpdated;
use Callmeaf\User\Http\Requests\V1\Api\UserDestroyRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserForceDestroyRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserIndexRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserProfileImageUpdateRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserRestoreRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserShowRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserStatusUpdateRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserStoreRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserSyncRolesRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserTrashedIndexRequest;
use Callmeaf\User\Http\Requests\V1\Api\UserUpdateRequest;
use Callmeaf\User\Models\User;
use Callmeaf\User\Services\V1\UserService;

class UserController extends ApiController
{
    protected UserService $userService;
    public function __construct()
    {
        app(config('callmeaf-user.middlewares.user'))($this);
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

    public function store(UserStoreRequest $request)
    {
        try {
            $user = $this->userService->create(data: $request->validated(),events: [
                UserStored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-user.resources.store.attributes'),relations: config('callmeaf-user.resources.store.relations'));
            return apiResponse([
                'user' => $user,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $user->responseTitles('store'),
            ]));
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

    public function update(UserUpdateRequest $request,User $user)
    {
        try {
            $user = $this->userService->setModel($user)->update(data: $request->validated(),events: [
                UserUpdated::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-user.resources.update.attributes'),relations: config('callmeaf-user.resources.update.relations'));
            return apiResponse([
                'user' => $user,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $user->responseTitles('update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(UserStatusUpdateRequest $request,User $user)
    {
        try {
            $user = $this->userService->setModel($user)->update([
                'status' => $request->get('status'),
            ])->getModel(asResource: true,attributes: config('callmeaf-user.resources.status_update.attributes'),relations: config('callmeaf-user.resources.status_update.relations'));
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_updated', [
                 'title' =>  $user->responseTitles('status_update')
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(UserDestroyRequest $request,User $user)
    {
        try {
             $user = $this->userService->setModel($user)->delete(events: [
                 UserDestroyed::class,
             ])->getModel(asResource: true,attributes: config('callmeaf-user.resources.destroy.attributes'),relations: config('callmeaf-user.resources.destroy.relations'));
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_deleted', [
                 'title' =>  $user->responseTitles('destroy')
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function restore(UserRestoreRequest $request,string|int $id)
    {
        try {
            $user = $this->userService->restore(id: $id,idColumn: config('callmeaf-user.resources.restore.id_column'),events: [
                UserRestored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-user.resources.restore.attributes'),relations: config('callmeaf-user.resources.restore.relations'));
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_restored',[
                 'title' =>  $user->responseTitles('restore')
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function trashed(UserTrashedIndexRequest $request)
    {
        try {
            $users = $this->userService->onlyTrashed()->all(
                relations: config('callmeaf-user.resources.trashed.relations'),
                columns: config('callmeaf-user.resources.trashed.columns'),
                filters: $request->validated(),
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-user.resources.trashed.attributes'));
            return apiResponse([
                'users' => $users,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function forceDestroy(UserForceDestroyRequest $request,string|int $id)
    {
        try {
            $user = $this->userService->forceDelete(id: $id,idColumn: config('callmeaf-user.resources.force_destroy.id_column'),columns: config('callmeaf-user.resources.force_destroy.columns'),events: [
                UserForceDestroyed::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-user.resources.force_destroy.attributes'),relations: config('callmeaf-user.resources.force_destroy.relations'));
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_force_destroyed',[
                 'title' =>  $user->responseTitles('force_destroy')
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function syncRoles(UserSyncRolesRequest $request,User $user)
    {
        try {
            $user = $this->userService->setModel($user)->syncRoles(roles: $request->get('roles_ids',[]))->getModel(asResource: true,attributes: config('callmeaf-user.resources.sync_roles.attributes'),relations: config('callmeaf-user.resources.sync_roles.relations'));
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_updated', [
                 'title' => $user->responseTitles('sync_roles')
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function profileImageUpdate(UserProfileImageUpdateRequest $request)
    {
        try {
            $user = $this->userService->setModel($request->user())->createMedia(
                file: $request->file('image'),
                collection: MediaCollection::IMAGE,
                disk: MediaDisk::USERS,
            )->getModel(asResource: true,attributes: config('callmeaf-user.resources.profile_image_update.attributes'),relations: config('callmeaf-user.resources.profile_image_update.relations'));
            return apiResponse([
                'user' => $user,
            ],__('callmeaf-base::v1.successful_updated_non_title'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}
