<?php

declare(strict_types=1);

namespace HazzelValidation;

use ReflectionClass;
use BadFunctionCallException;

/**
 * Factory class for creating rule instances
 */
final class RuleFactory
{
    public static function createRuleInstance(string $rule, array $args = []): Rules\AbstractRule
    {
        try {
            $ruleInstance = new ReflectionClass(__NAMESPACE__ . '\\Rules\\' . ucfirst($rule));
            return $ruleInstance->newInstanceArgs($args);
        } catch (\ReflectionException $e) {
            throw new BadFunctionCallException("Rule '{$rule}' does not exist");
        }
    }
}
