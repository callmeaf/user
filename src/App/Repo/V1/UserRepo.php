<?php

namespace Callmeaf\User\App\Repo\V1;

use Callmeaf\Base\App\Repo\V1\BaseRepo;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;

class UserRepo extends BaseRepo implements UserRepoInterface
{
    public function updatePassword(string $id, string $password)
    {
        return $this->update($id, [
            'password' => $password,
        ]);
    }
}
