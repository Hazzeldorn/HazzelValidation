<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;

final class OneOfTest extends TestCase
{




   /**
   *  Test valid results
   */
    public function testValidResults(): void
    {
        $this->assertTrue(
            Validation::string()->oneOf(['foo', 'bar'])->check('foo')
            && Validation::string()->oneOf(['foo', 'bar'], false)->check('FOO')
            && Validation::create()->oneOf([1, 2])->check(1)
            && Validation::create()->oneOf([1, 2])->check('2')
        );
    }


   /**
   *  Test invalid results
   */
    public function testInvalidResults(): void
    {
        $this->assertFalse(
            Validation::string()->oneOf([])->check('foo')
            || Validation::string()->oneOf([])->check('')
            || Validation::string()->oneOf()->check('test')
            || Validation::string()->oneOf(['foo', 'bar'], true)->check('FOO')
            || Validation::create()->oneOf([-1, 2])->check(3)
        );
    }
}
