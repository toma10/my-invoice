<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                $this->isUpdateRequest()
                    ? Rule::unique('departments', 'name')->ignore($this->route('department'), 'name')
                    : Rule::unique('departments', 'name'),
            ],
        ];
    }

    public function isUpdateRequest(): bool
    {
        return $this->route('department') !== null;
    }
}
