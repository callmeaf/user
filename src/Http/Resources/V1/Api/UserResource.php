<?php

namespace Callmeaf\User\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
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
            'image' => fn() => new MediaResource($this->image,only: $this->only['!image'] ?? []),
        ],only: $this->only);
    }
}
