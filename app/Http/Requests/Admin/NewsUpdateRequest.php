<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $newsId = $this->route('news')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('news', 'slug')->ignore($newsId)],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'cover_image' => ['nullable', 'file', 'image', 'max:3072'],
            'sponsor_title' => ['nullable', 'string', 'max:255'],
            'sponsor_body' => ['nullable', 'string'],
            'sponsor_link' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['file', 'image', 'max:3072'],
            'remove_cover_image' => ['nullable', 'boolean'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['integer'],
        ];
    }
}
