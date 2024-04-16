<?php

namespace Callmeaf\User\Http\Requests\V1\Api;

use Callmeaf\User\Enums\UserStatus;
use Callmeaf\User\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')->id;
        return validationManager(rules: [
            'status' => [new Enum(UserStatus::class)],
            'type' => [new Enum(UserType::class)],
            'first_name' => ['string','min:3','max:255'],
            'last_name' => ['string','min:3','max:255'],
            'national_code' => ['digits:10',Rule::unique(config('callmeaf-user.model'),'national_code')->ignore($userId)],
            'email' => ['email',Rule::unique(config('callmeaf-user.model'),'email')->ignore($userId)],
        ],filters: config("callmeaf-user.validations.update"));
    }

}
