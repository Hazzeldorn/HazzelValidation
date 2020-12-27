<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

final class Email extends AbstractRule
{

    private $validFormatExpected;

    public function __construct(bool $validFormatExpected = true)
    {
        $this->validFormatExpected = $validFormatExpected;
    }

    public function validate($input): bool
    {
        if (!is_string($input)) {
            return $this->validFormatExpected ? false : true;
        }

        $isEmail = (bool) filter_var($input, FILTER_VALIDATE_EMAIL);
        return $this->validFormatExpected ? $isEmail : !$isEmail;
    }
}
