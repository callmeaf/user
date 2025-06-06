<?php

namespace Callmeaf\User\App\Http\Resources\Admin\V1;

use App\Models\User;
use Callmeaf\Media\App\Repo\Contracts\MediaRepoInterface;
use Callmeaf\Role\App\Repo\Contracts\RoleRepoInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var MediaRepoInterface $mediaRepo
         */
        $mediaRepo = app(MediaRepoInterface::class);
        /**
         * @var RoleRepoInterface $roleRepo
         */
        $roleRepo = app(RoleRepoInterface::class);
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_text' => $this->statusText,
            'type' => $this->type,
            'type_text' => $this->typeText,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'created_at_text' => $this->createdAtText(),
            'updated_at' => $this->updated_at,
            'updated_at_text' => $this->updatedAtText(),
            'deleted_at' => $this->deleted_at,
            'deleted_at_text' => $this->deletedAtText(),
            'image' => $mediaRepo->toResource($this->whenLoaded('image')),
            'roles' => $roleRepo->toResourceCollection($this->whenLoaded('roles')),
        ];
    }
}
