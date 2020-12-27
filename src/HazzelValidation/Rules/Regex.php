<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

final class Regex extends AbstractRule
{

    private $regex;
    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match($this->regex, (string) $input) > 0;
    }
}
