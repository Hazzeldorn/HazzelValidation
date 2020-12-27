<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

final class NotEmpty extends AbstractRule
{
    public function validate($input): bool
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
    }
}
