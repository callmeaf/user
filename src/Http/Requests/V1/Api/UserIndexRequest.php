<?php

namespace Callmeaf\User\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
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
        return validationManager(rules: [
            'mobile' => [],
            'email' => [],
            'first_name' => [],
            'last_name' => [],
        ],filters: [
            ...config("callmeaf-user.validations.index"),
            ...config('callmeaf-base.default_searcher_validation'),
        ]);
    }

}
