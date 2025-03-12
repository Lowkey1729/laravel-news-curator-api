<?php

namespace App\Concerns;

use App\Responses\V1\FailureResponse;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait FailedValidationTrait
{
    protected function failedValidation(Validator $validator)
    {
        $validationMessage = $this->stringifyMessageBagError($validator->errors());
        $response = (new FailureResponse($validationMessage))->toResponse($this);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

    protected function stringifyMessageBagError(MessageBag $errors): string
    {
        $errorsCount = count($errors);
        $errorPlural = ($errorsCount - 1) > 1 ? 'errors' : 'error';

        if ($errorsCount > 1) {
            return sprintf(
                '%s plus %s other %s',
                rtrim($errors->first(), '.'),
                $errorsCount,
                $errorPlural
            );
        }

        return $errors->first();
    }
}
