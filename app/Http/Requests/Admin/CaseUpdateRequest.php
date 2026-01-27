<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CaseUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $caseId = $this->route('case')?->id;

        return [
            'case_number' => ['nullable', 'string', 'max:50', Rule::unique('cases', 'case_number')->ignore($caseId)],
            'name' => ['required', 'string', 'max:255'],
            'national_id' => ['nullable', 'string', 'max:50', Rule::unique('cases', 'national_id')->ignore($caseId)],
            'phone' => ['nullable', 'string', 'max:50', Rule::unique('cases', 'phone')->ignore($caseId)],
            'family_members_count' => ['nullable', 'integer', 'min:1'],
            'address' => ['nullable', 'string'],
            'area_id' => ['required', 'exists:areas,id'],
            'case_type_id' => ['required', 'exists:case_types,id'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'max:5120'],
        ];
    }
}
