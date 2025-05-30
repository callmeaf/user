<?php

namespace Callmeaf\User\App\Http\Requests\Admin\V1;

use Callmeaf\Role\App\Repo\Contracts\RoleRepoInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserSyncRolesRequest extends FormRequest
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
    public function rules(RoleRepoInterface $roleRepo): array
    {
        return [
            'roles_ids' => ['nullable','array'],
            'roles_ids.*' => ['required',Rule::exists($roleRepo->getTable(),$roleRepo->getModel()->getKeyName())],
        ];
    }
}
