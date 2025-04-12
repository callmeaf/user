<?php

namespace Callmeaf\User\App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @extends ResourceCollection<UserResource>
 */
class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, UserResource>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
