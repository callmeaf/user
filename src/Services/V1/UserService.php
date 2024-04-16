<?php

namespace Callmeaf\User\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
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


}
