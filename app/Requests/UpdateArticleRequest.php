<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'min:5', 'max:100'],
            'content' => ['sometimes', 'string', 'min:10', 'max:1000'],
            'url' => ['sometimes', 'url'],
            'slug' => ['nullable', 'unique:articles,slug'],
        ];
    }

    public function prepareForValidation(): void
    {
        if (! $this->input('title')) {
            return;
        }

        $this->merge([
            'slug' => Str::slug($this->input('title')),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
