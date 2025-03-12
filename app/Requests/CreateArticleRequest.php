<?php

namespace App\Requests;

use App\Concerns\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
    use FailedValidationTrait;

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'content' => ['required', 'string', 'min:10', 'max:1000'],
            'url' => ['required', 'url'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
