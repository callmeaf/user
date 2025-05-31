<?php

namespace Callmeaf\User\App\Repo\V1;

use Callmeaf\Base\App\Repo\V1\BaseRepo;
use Callmeaf\Role\App\Repo\Contracts\RoleRepoInterface;
use Callmeaf\User\App\Events\Admin\V1\UserSyncedRoles;
use Callmeaf\User\App\Http\Resources\Admin\V1\UserResource;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface
{
    public function updatePassword(string $id, string $password)
    {
        return $this->update($id, [
            'password' => $password,
        ]);
    }

    public function syncRoles(string $id, array $rolesIds)
    {
        /**
         * @var UserResource $user
         */
        $user = $this->findById($id);

        $changes = $user->resource->roles()->sync($rolesIds);

        $user->resource->loadMissing(['roles']);

        $roleRepo = app(RoleRepoInterface::class);

        foreach ($changes as $key => $values) {
            if(empty($values)) {
                continue;
            }
            $roleRepo->freshQuery();
            $changes[$key] = $roleRepo->getQuery()->select(['id','name','name_fa'])->whereIn('id',$values)->get()->map(fn($item) => $item->nameText)->toArray();
        }

        UserSyncedRoles::dispatch($user->resource,$changes['attached'],$changes['detached'],$changes['updated']);

        return $user;
    }
}
