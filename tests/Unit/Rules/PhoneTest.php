<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;
use stdClass;

final class PhoneTest extends TestCase
{




   /**
   *  Test valid results
   */
    public function testValidResults(): void
    {
        $this->assertTrue(
            Validation::string()->phone()->check('036106666')
            && Validation::string()->phone()->check('+41 99 888 77 66')
            && Validation::string()->phone()->check('0041 99 888 77 66')
            && Validation::string()->phone()->check('+41998887766')
            && Validation::string()->phone()->check('+41 033 888 77 66')
            && Validation::string()->phone()->check('+410338887766')
            && Validation::string()->phone()->check('+410338887766')
        );
    }


   /**
   *  Test invalid results
   */
    public function testInvalidResults(): void
    {
        $this->assertFalse(
            Validation::string()->phone()->check('')
            || Validation::string()->phone()->check(' ')
            || Validation::string()->phone()->check('tel:036106665')
            || Validation::string()->phone()->check('test')
            || Validation::string()->phone()->check([])
            || Validation::string()->phone()->check(new stdClass())
        );
    }
}
