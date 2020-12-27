<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

/**
* Validates whether the input is a valid phone number.
*/
final class Phone extends AbstractRule
{

    public function validate($input): bool
    {
        if (!is_scalar($input) || empty(trim((string) $input))) {
            return false;
        }

        return preg_match($this->getPregFormat(), (string) $input) > 0;
    }

    private function getPregFormat(): string
    {
        return '/^[+]{0,1}[- \(\)\/0-9]{3,20}$/';

        /* professional function from respect validation
        return sprintf(
            '/^\+?(%1$s)? ?(?(?=\()(\(%2$s\) ?%3$s)|([. -]?(%2$s[. -]*)?%3$s))$/',

            '\d{0,3}',
            '\d{1,3}',
            '((\d{3,5})[. -]?(\d{4})|(\d{2}[. -]?){4})'
        );
        */
    }
}
