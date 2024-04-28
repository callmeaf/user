<?php

namespace Callmeaf\User\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;


class UserTrashedIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-user.form_request_authorizers.user'))->trashed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [

        ],filters: config("callmeaf-user.validations.trashed"));
    }

}
