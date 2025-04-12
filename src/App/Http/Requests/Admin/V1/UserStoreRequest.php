<?php

namespace Callmeaf\User\App\Http\Requests\Admin\V1;

use Callmeaf\User\App\Enums\UserStatus;
use Callmeaf\User\App\Enums\UserType;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
        $userRepo = app(UserRepoInterface::class);
        return [
            'status' => ['required', Rule::enum(UserStatus::class)],
            'type' => ['required', Rule::enum(UserType::class)],
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'mobile' => ['required', 'starts_with:09', 'digits:11', Rule::unique($userRepo->getTable(), 'mobile')],
            'email' => ['required', 'email', Rule::unique($userRepo->getTable(), 'email')],
        ];
    }
}
