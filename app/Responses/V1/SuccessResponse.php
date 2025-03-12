<?php

namespace App\Responses\V1;

use App\Concerns\ResponseTrait;
use App\Responses\Contracts\ApiResponseInterface;
use Illuminate\Contracts\Support\Responsable;

class SuccessResponse implements ApiResponseInterface, Responsable
{
    use ResponseTrait;

    public function __construct(
        public readonly string $message,
        public readonly array $data = [],
        public readonly array $topLevelData = [],
        public readonly int $statusCode = 200,
    ) {}

    public static function make(
        string $message,
        array $data = [],
        array $topLevelData = [],
        int $statusCode = 200,
    ): static {
        return new static(
            message: $message,
            data: $data,
            topLevelData: $topLevelData,
            statusCode: $statusCode
        );
    }

    public function getResponseBlock(): array
    {
        return [
            'success' => true,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => [],
            'extra' => $this->topLevelData,
        ];
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
