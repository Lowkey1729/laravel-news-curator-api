<?php

namespace App\Requests;

use App\DTOs\FetchArticlesRequestData;
use App\Rules\IsBoolean;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class FetchArticlesRequest extends FormRequest
{
    /** @use WithData<string>*/
    use WithData;

    public function rules(): array
    {
        return [
            'title' => ['sometimes'],
            'views' => ['sometimes', 'integer'],
            'clicks' => ['sometimes', 'integer'],
            'page' => ['sometimes', 'integer', 'min:1'],
            'limit' => ['sometimes', 'integer', 'min:1'],
            'created_at' => ['sometimes', 'date_format:Y-m-d'],
            'desc' => ['sometimes', new IsBoolean],
            'sort_by' => ['sometimes', 'string', 'in:views,title,id,clicks'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'desc' => filter_var($this->input('desc'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function dataClass(): string
    {
        return FetchArticlesRequestData::class;
    }
}
