<?php

namespace Callmeaf\User\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
use Callmeaf\Permission\Http\Resources\V1\Api\RoleCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class UserResource extends JsonResource
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        Log::alert(json_encode($this->only));
        return toArrayResource(data: [
            'id' => fn() => $this->id,
            'status' => fn() => $this->status,
            'status_text' => fn() => $this->statusText,
            'type' => fn() => $this->type,
            'type_text' => fn() => $this->typeText,
            'first_name' => fn() => $this->first_name,
            'last_name' => fn() => $this->last_name,
            'full_name' => fn() => $this->fullName,
            'mobile' => fn() => $this->mobile,
            'email' => fn() => $this->email,
            'email_verified_at' => fn() => $this->email_verified_at,
            'national_code' => fn() => $this->national_code,
            'created_at' => fn() => $this->created_at,
            'created_at_text' => fn() => $this->createdAtText,
            'updated_at' => fn() => $this->updated_at,
            'updated_at_text' => fn() => $this->updatedAtText,
            'deleted_at' => fn() => $this->deleted_at,
            'deleted_at_text' => fn() => $this->deletedAtText,
            'image' => fn() => $this->image ? new (config('callmeaf-media.model_resource'))($this->image,only: $this->only['!image'] ?? []) : null,
            'roles_ids' => fn() => $this->roles()->pluck('id'),
            'roles' => fn() => $this->roles?->count() ? new (config('callmeaf-role.model_resource_collection'))($this->roles,only: $this->only['!roles'] ?? []) : null,
            'carts' => fn() => $this->carts?->count() ? new (config('callmeaf-cart.model_resource_collection'))($this->carts,only: $this->only['!carts'] ?? []) : null,
        ],only: $this->only);
    }
}
