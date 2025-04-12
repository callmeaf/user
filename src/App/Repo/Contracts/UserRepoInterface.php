<?php

namespace Callmeaf\User\App\Repo\Contracts;

use App\Models\User;
use Callmeaf\Base\App\Repo\Contracts\BaseRepoInterface;
use Callmeaf\User\App\Http\Resources\Api\V1\UserCollection;
use Callmeaf\User\App\Http\Resources\Api\V1\UserResource;

/**
 * @extends BaseRepoInterface<User,UserResource,UserCollection>
 */
interface UserRepoInterface extends BaseRepoInterface
{
    /**
     * @param string $id
     * @param string $password
     * @return UserResource
     */
    public function updatePassword(string $id, string $password);
}
