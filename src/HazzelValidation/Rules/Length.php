<?php

declare(strict_types=1);

namespace HazzelValidation\Rules;

use InvalidArgumentException;

final class Length extends AbstractRule
{

    private $exact = null;
    private $minValue;
    private $maxValue;
    private $inclusive;

    /**
     * Creates the rule with a minimum and maximum value.
     */
    public function __construct(?int $min, ?int $max = null, bool $inclusive = true)
    {
        // check if input is valid
        if ($max !== null && $min > $max) {
            throw new InvalidArgumentException(sprintf('%d cannot be less than %d for validation', $min, $max));
        }

        if ($min < 0 || $max < 0) {
            throw new InvalidArgumentException('length cannot be less than zero');
        }


        if (func_num_args() == 1) {
            // only one param is defined -> check the exact length
            $this->exact = $min;
        } else {
            $this->minValue = $min;
            $this->maxValue = $max;
            $this->inclusive = $inclusive;
        }
    }

    public function validate($input): bool
    {
        $length = $this->extractLength($input);
        if ($length === null) {
            return false;
        }

        if ($this->exact !== null) {
            return $this->validateExact($length);
        }

        return $this->validateMin($length) && $this->validateMax($length);
    }

    private function extractLength($input): ?int
    {
        if (is_string($input)) {
            return (int) mb_strlen($input, (string) mb_detect_encoding($input));
        }

        if (is_array($input)) {
            return count($input);
        }

        if (is_object($input)) {
            return $this->extractLength(get_object_vars($input));
        }

        if (is_int($input)) {
            return $this->extractLength((string) $input);
        }

        return null;
    }

    private function validateMin(int $length): bool
    {
        if ($this->inclusive) {
            return $length >= $this->minValue;
        }

        return $length > $this->minValue;
    }

    private function validateMax(int $length): bool
    {
        if ($this->maxValue === null) {
            return true;
        }

        if ($this->inclusive) {
            return $length <= $this->maxValue;
        }

        return $length < $this->maxValue;
    }

    private function validateExact(int $length): bool
    {
        return $length == $this->exact;
    }
}
