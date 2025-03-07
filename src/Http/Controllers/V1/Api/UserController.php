<?php

namespace Callmeaf\User\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Media\Enums\MediaCollection;
use Callmeaf\Media\Enums\MediaDisk;
use Callmeaf\User\Events\UserDestroyed;
use Callmeaf\User\Events\UserForceDestroyed;
use Callmeaf\User\Events\UserIndexed;
use Callmeaf\User\Events\UserProfileImageUpdated;
use Callmeaf\User\Events\UserRestored;
use Callmeaf\User\Events\UserShowed;
use Callmeaf\User\Events\UserStatusUpdated;
use Callmeaf\User\Events\UserStored;
use Callmeaf\User\Events\UserSyncedRoles;
use Callmeaf\User\Events\UserTrashed;
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
use Callmeaf\User\Utilities\V1\Api\User\UserResources;

class UserController extends ApiController
{
    protected UserService $userService;
    protected UserResources $userResources;
    public function __construct()
    {
        app(config('callmeaf-user.middlewares.user'))($this);
        $this->userService = app(config('callmeaf-user.service'));
        $this->userResources = app(config('callmeaf-user.resources.user'));
    }

    public static function middleware(): array
    {
        return app(config('callmeaf-user.middlewares.user'))();
    }

    public function index(UserIndexRequest $request)
    {
        try {
            $resources = $this->userResources->index();
            $users = $this->userService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    UserIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
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
            $resources = $this->userResources->store();
            $user = $this->userService->create(data: $request->validated(),events: [
                UserStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'user' => $user,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $user->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(UserShowRequest $request,User $user)
    {
        try {
            $resources = $this->userResources->show();
            $user = $this->userService->setModel($user)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    UserShowed::class,
                ],
            );
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
            $resources = $this->userResources->update();
            $user = $this->userService->setModel($user)->update(data: $request->validated(),events: [
                UserUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'user' => $user,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $user->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(UserStatusUpdateRequest $request,User $user)
    {
        try {
            $resources = $this->userResources->statusUpdate();
            $user = $this->userService->setModel($user)->update([
                'status' => $request->get('status'),
            ],events: [
                UserStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_updated', [
                 'title' =>  $user->responseTitles(ResponseTitle::STATUS_UPDATE)
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(UserDestroyRequest $request,User $user)
    {
        try {
            $resources = $this->userResources->destroy();
             $user = $this->userService->setModel($user)->delete(events: [
                 UserDestroyed::class,
             ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_deleted', [
                 'title' =>  $user->responseTitles(ResponseTitle::DESTROY)
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


    public function restore(UserRestoreRequest $request,string|int $id)
    {
        try {
            $resources = $this->userResources->restore();
            $user = $this->userService->restore(id: $id,idColumn: $resources->idColumn(),events: [
                UserRestored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_restored',[
                 'title' =>  $user->responseTitles(ResponseTitle::RESTORE)
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function trashed(UserTrashedIndexRequest $request)
    {
        try {
            $resources = $this->userResources->trashed();
            $users = $this->userService->onlyTrashed()->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    UserTrashed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
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
            $resources = $this->userResources->forceDestroy();
            $user = $this->userService->forceDelete(id: $id,idColumn: $resources->idColumn(),columns: $resources->columns(),events: [
                UserForceDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
             return apiResponse([
                 'user' => $user,
             ],__('callmeaf-base::v1.successful_force_destroyed',[
                 'title' =>  $user->responseTitles(ResponseTitle::FORCE_DESTROY)
             ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function syncRoles(UserSyncRolesRequest $request,User $user)
    {
        try {
            $resources = $this->userResources->syncRoles();
            $user = $this->userService->setModel($user)->syncRoles(roles: $request->get('roles_ids',[]))->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    UserSyncedRoles::class,
                ],
            );
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

    public function profileImageUpdate(UserProfileImageUpdateRequest $request,User $user)
    {
        try {
            $resources = $this->userResources->profileImageUpdate();
            $user = $this->userService->setModel($user)->createMedia(
                file: $request->file('image'),
                collection: MediaCollection::IMAGE,
                disk: MediaDisk::USERS,
            )->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    UserProfileImageUpdated::class,
                ],
            );
            return apiResponse([
                'user' => $user,
            ],__('callmeaf-base::v1.successful_updated_non_title'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}
