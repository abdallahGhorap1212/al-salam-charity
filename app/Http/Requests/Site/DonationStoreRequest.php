<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class DonationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'amount' => ['nullable', 'numeric', 'min:1'],
            'service_id' => ['nullable', 'exists:services,id'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
