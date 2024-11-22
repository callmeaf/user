<?php

namespace Callmeaf\User\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn($user) => toArrayResource(data: [
                'id' => fn() => $user->id,
                'status' => fn() => $user->status,
                'status_text' => fn() => $user->statusText,
                'type' => fn() => $user->type,
                'type_text' => fn() => $user->typeText,
                'mobile' => fn() => $user->mobile,
                'email' => fn() => $user->email,
                'first_name' => fn() => $user->first_name,
                'last_name' => fn() => $user->last_name,
                'national_code' => fn() => $user->national_code,
                'email_verified_at' => fn() => $user->email_verified_at,
                'created_at' => fn() => $user->created_at,
                'created_at_text' => fn() => $user->createdAtText,
                'updated_at' => fn() => $user->updated_at,
                'updated_at_text' => fn() => $user->updatedAtText,
                'deleted_at' => fn() => $user->deleted_at,
                'deleted_at_text' => fn() => $user->deletedAtText,
                'image' => fn() => $user->image ? new (config('callmeaf-media.model_resource'))($user->image,only: $this->only['!image'] ?? []) : null,
                'roles_ids' => fn() => $user->roles()->pluck('id'),
                'roles' => fn() => $user->roles?->count() ? new (config('callmeaf-role.model_resource_collection'))($user->roles,only: $this->only['!roles'] ?? []) : null,
                'carts' => fn() => $user->carts?->count() ? new (config('callmeaf-cart.model_resource_collection'))($user->carts,only: $this->only['!carts'] ?? []) : null,
            ],only: $this->only)),
        ];
    }
}
