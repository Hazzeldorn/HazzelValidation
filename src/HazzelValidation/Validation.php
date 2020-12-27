<?php

declare(strict_types=1);

namespace HazzelValidation;

use BadFunctionCallException;

final class Validation
{

    private $rules = [];
    private $isOptional = false;

    public function __construct(array $settings = [])
    {
        // add settings (rules)
        if (!empty($settings)) {
            foreach ($settings as $rule => $args) {
                $args = is_array($args) ? $args : [$args];
            // add array wrap if needed
                $this->addRule(RuleFactory::createRuleInstance($rule, $args));
            }
        }
    }

    public static function create(array $settings = []): self
    {
        return new self($settings);
    }

    public static function string(): self
    {
        return new self(['type' => 'string']);
    }

    public static function bool(): self
    {
        return new self(['type' => 'boolean']);
    }

    public static function boolean(): self
    {
        return new self(['type' => 'boolean']);
    }

    public static function int(): self
    {
        return new self(['type' => 'int']);
    }

    public static function integer(): self
    {
        return new self(['type' => 'integer']);
    }

    public static function float(): self
    {
        return new self(['type' => 'float']);
    }

    public static function number(): self
    {
        return new self(['type' => 'number']); // allows int and float
    }

    public static function array(): self
    {
        return new self(['type' => 'array']);
    }

    public static function object(): self
    {
        return new self(['type' => 'object']);
    }

    public function __call(string $rule, array $args = []): self
    {
        if ($rule == 'optional') {
            $this->isOptional = true;
        } else {
            $this->addRule(RuleFactory::createRuleInstance($rule, $args));
        }

        return $this;
    }


    private function addRule(Rules\AbstractRule $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }


    public function check($input): bool
    {

        // check if enough rules exist
        if (count($this->rules) < 1) {
            throw new BadFunctionCallException("Too few validation rules");
        }

        // check if input is empty / undefined
        if (in_array($input, [null, ''], true) && $this->isOptional) {
            return true;
        }

        return (bool) $this->validateRules($input);
    }

    public function checkAll(array $input): bool
    {

        // check if enough rules exist
        if (count($this->rules) < 1) {
            throw new BadFunctionCallException("No validation rules");
        }

        $isValid = true;
        $i = 0;
// check every input
        while ($isValid && $i < count($input)) {
            $isValid = $this->validateRules($input[$i]);
            $i++;
        }

        return $isValid;
    }

    private function validateRules($input): bool
    {

        // check all the rules
        foreach ($this->rules as $rule) {
            if (!$rule->validate($input)) {
                return false;
            }
        }

        // everything looks fine
        return true;
    }
}
