<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'content' => ['required', 'string', 'min:10', 'max:1000'],
            'url' => ['required', 'url'],
            'slug' => ['nullable', 'unique:articles,slug'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('title')),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
