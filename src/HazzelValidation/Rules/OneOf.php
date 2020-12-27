<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

/**
*     Checks if a string can be found in an array
*/
final class OneOf extends AbstractRule
{

    private $haystack;
    private $caseSensitive;

    public function __construct(array $haystack = [], bool $caseSensitive = true)
    {
        $this->haystack = ($caseSensitive) ? $haystack : array_map('strtolower', $haystack);
        $this->caseSensitive = $caseSensitive;
    }


    public function validate($input): bool
    {

        if (!is_scalar($input)) {
            return false;
        }

        if (is_string($input) && !$this->caseSensitive) {
            $input = strtolower($input);
        }

        return in_array($input, $this->haystack);
    }
}
