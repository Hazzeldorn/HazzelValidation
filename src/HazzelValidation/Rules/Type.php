<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

final class Type extends AbstractRule
{

    private $requiredType;

    public function __construct(string $type)
    {
        $this->requiredType = $type;
    }

    public function validate($input): bool
    {
        switch ($this->requiredType) {
            case 'bool':
                return is_bool($input);
                break;
            case 'boolean':
                return is_bool($input);
                break;
            case 'string':
                return is_string($input);
                break;
            case 'int':
                return is_int($input);
                break;
            case 'integer':
                return is_int($input);
                break;
            case 'float':
                return is_float($input);
                break;
            case 'number':
                return is_numeric($input) && !is_nan((float) $input);
                break;
            case 'array':
                return is_array($input);
                break;
            case 'object':
                return is_object($input);
                break;
        }

        return false;
    }
}
