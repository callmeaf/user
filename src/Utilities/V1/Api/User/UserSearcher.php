<?php

namespace Callmeaf\User\Utilities\V1\Api\User;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class UserSearcher implements SearcherInterface
{
    public function apply(Builder $query, array $filters = []): void
    {
        $filters = collect($filters)->filter(fn($item) => strlen(trim($item)));
        $query->where(function(Builder $builder) use ($filters) {
            $searcherSubClassQueryFunction = config('callmeaf-base.searcher_subclass_query_function');

            if($value = $filters->get('mobile')) {
                $builder->{$searcherSubClassQueryFunction}('mobile','like',searcherLikeValue($value));
            }
            if($value = $filters->get('email')) {
                $builder->{$searcherSubClassQueryFunction}('email','like',searcherLikeValue($value));
            }
            if($value = $filters->get('first_name')) {
                $builder->{$searcherSubClassQueryFunction}('first_name','like',searcherLikeValue($value));
            }
            if($value = $filters->get('last_name')) {
                $builder->{$searcherSubClassQueryFunction}('last_name','like',searcherLikeValue($value));
            }
        });

    }
}
