<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;

final class OptionalTest extends TestCase
{




   /**
   *  Test valid results
   */
    public function testValidResults(): void
    {
        $this->assertTrue(
            Validation::string()->optional()->check(null)
            && Validation::string()->optional()->check('')
            && Validation::string()->optional()->check(' ')
            && Validation::number()->check(0)
            && Validation::number()->check(0.0)
            && Validation::string()->phone()->optional()->check('0330023029')
        );
    }


   /**
   *  Test invalid results
   */
    public function testInvalidResults(): void
    {
        $this->assertFalse(
            Validation::string()->optional()->check(1)
            || Validation::string()->phone()->optional()->check('wrong number')
        );
    }
}
