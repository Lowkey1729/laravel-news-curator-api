<?php

namespace App\Responses\V1;

use App\Concerns\ResponseTrait;
use App\Responses\Contracts\ApiResponseInterface;
use Illuminate\Contracts\Support\Responsable;

class FailureResponse implements ApiResponseInterface, Responsable
{
    use ResponseTrait;

    public function __construct(
        protected string $message,
        protected array $data = [],
        protected array $errors = [],
        protected int $statusCode = 200
    ) {}

    public static function make(string $message, array $data = [], array $errors = [], int $statusCode = 200): self
    {
        return new static($message, $data, $errors, $statusCode);
    }

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
