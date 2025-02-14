<?php

namespace Callmeaf\User\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserSyncRolesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-user.form_request_authorizers.user'))->syncRoles();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'roles_ids' => ['array'],
            'roles_ids.*' => [Rule::exists(config('callmeaf-role.model'),'id')],
        ],filters: app(config("callmeaf-user.validations.user"))->syncRoles());
    }

}
