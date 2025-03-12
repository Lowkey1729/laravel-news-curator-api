<?php

namespace App\Responses\Contracts;

interface ApiResponseInterface
{
    public function getResponseBlock();

    public function getStatusCode();
}
