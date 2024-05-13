<?php

namespace Callmeaf\User\Utilities\V1\User\Api;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class UserSearcher implements SearcherInterface
{
    public function apply(Builder $query, array $filters = []): void
    {
        $filters = collect($filters)->filter(fn($item) => strlen(trim($item)));
        if($value = $filters->get('mobile')) {
            $query->where('mobile','like',searcherLikeValue($value));
        }
        if($value = $filters->get('email')) {
            $query->where('email','like',searcherLikeValue($value));
        }
        if($value = $filters->get('first_name')) {
            $query->where('first_name','like',searcherLikeValue($value));
        }
        if($value = $filters->get('last_name')) {
            $query->where('last_name','like',searcherLikeValue($value));
        }
    }
}
