<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;
use stdClass;

final class NotEmptyTest extends TestCase
{




   /**
   *  Test valid results
   */
    public function testValidResults(): void
    {
        $this->assertTrue(
            Validation::create()->notEmpty()->check(1)
            && Validation::create()->notEmpty()->check('test')
            && Validation::create()->notEmpty()->check([123])
            && Validation::create()->notEmpty()->check([0])
            && Validation::create()->notEmpty()->check(new stdClass())
        );
    }


   /**
   *  Test invalid results
   */
    public function testInvalidResults(): void
    {
        $this->assertFalse(
            Validation::create()->notEmpty()->check('')
            || Validation::create()->notEmpty()->check('    ')
            || Validation::create()->notEmpty()->check("\n")
            || Validation::create()->notEmpty()->check(false)
            || Validation::create()->notEmpty()->check(null)
            || Validation::create()->notEmpty()->check([])
        );
    }
}
