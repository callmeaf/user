<?php

namespace Callmeaf\User\App\Http\Requests\Admin\V1;

use Callmeaf\Base\App\Enums\ImportType;
use Illuminate\Foundation\Http\FormRequest;

class UserImportRequest extends FormRequest
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
        $mimes = \Base::mimesImportValidation(type: ImportType::tryFrom($this->route('type')));
        return [
            'file' => ['required', 'file', "mimes:$mimes"],
        ];
    }
}
