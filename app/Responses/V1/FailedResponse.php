<?php

namespace App\Responses\V1;

use App\Concerns\ResponseTrait;
use App\Responses\Contracts\ApiResponseInterface;
use Illuminate\Contracts\Support\Responsable;

class FailedResponse implements ApiResponseInterface, Responsable
{
    use ResponseTrait;

    public function __construct(
        protected string $message,
        protected array $data = [],
        protected array $errors = [],
        protected int $statusCode = 200
    ) {}

    public function getResponseBlock(): array
    {
        return [
            'success' => false,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
