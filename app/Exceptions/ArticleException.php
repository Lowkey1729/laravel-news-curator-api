<?php

namespace App\Exceptions;

use App\Responses\V1\FailureResponse;
use Exception;

class ArticleException extends Exception
{
    public function render()
    {
        return FailureResponse::make(
            message: $this->getMessage(),
            statusCode: $this->getCode() != 0 ? $this->getCode() : 400,
        );
    }
}
