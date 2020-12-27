<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

/**
 * Interface for validation rules
 */
abstract class AbstractRule
{
    /**
     * @param mixed $input
     */
    public function validate($input): bool
    {
        return false;
    }
}
