<?php

namespace Callmeaf\User\Utilities\V1;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class Searcher implements SearcherInterface
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
