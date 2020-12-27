<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;
use stdClass;

final class RegexTest extends TestCase
{




   /**
   *  Test valid results
   */
    public function testValidResults(): void
    {
        $this->assertTrue(
            Validation::create()->regex('/^[a-z]+$/')->check('easypeasy')
            && Validation::create()->regex('/^[a-z]+$/i')->check('LemonSqueezy')
            && Validation::create()->regex('/^[0-9]+$/i')->check(123)
            && Validation::create()->regex('/^[0-9]+$/i')->checkAll([1, 2, 3])
        );
/*
        *   No more tests needed because they it should be validated by PHP developers
        */
    }


   /**
   *  Test invalid results
   */
    public function testInvalidResults(): void
    {
        $this->assertFalse(
            Validation::create()->regex('/^w+$/')->check('blah blah')
            || Validation::create()->regex('/^w+$/')->check(new stdClass())
            || Validation::create()->regex('/^w+$/')->check([])
        );
    }
}
