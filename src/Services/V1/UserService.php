<?php

namespace Callmeaf\User\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Permission\Models\Role;
use Callmeaf\User\Models\User;
use Callmeaf\User\Services\V1\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-user.model'))->query();
        $this->resource = config('callmeaf-user.model_resource');
        $this->resourceCollection = config('callmeaf-user.model_resource_collection');
        $this->defaultData = config('callmeaf-user.default_values');
        $this->searcher = config('callmeaf-user.searcher');
    }

    public function syncRoles(iterable|Role|int|string|null $roles = []): UserService
    {
        if(!is_iterable($roles)) {
            $roles = is_null($roles) ? [] : [$roles];
        }
        foreach ($roles as $key => $role) {
            if(!($role instanceof Role)) {
                continue;
            }
            $roles[$key] = $role->id;
        }
        $this->model->roles()->sync($roles);
        $this->freshModel();
        return $this;
    }
}
