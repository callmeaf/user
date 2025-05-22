<?php

namespace Callmeaf\User\App\Http\Resources\Api\V1;

use App\Models\User;
use Callmeaf\Media\App\Repo\Contracts\MediaRepoInterface;
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'image' => $mediaRepo->toResource($this->whenLoaded('image')),
        ];
    }
}
