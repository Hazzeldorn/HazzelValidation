<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;
use stdClass;

final class EmailTest extends TestCase
{


    /**
    *  Test valid results
    */
    public function testValidResults(): void
    {
        $this->assertTrue(
            Validation::string()->email()->check('x@example-domai.berlin')
            && Validation::string()->email()->checkAll(['a@a.a', 'b@b.b'])
        );
        $this->assertTrue(
            Validation::create([
            'type' => 'string',
            'email' => true
            ])
            ->check('test@abc.com')
        );
    /**
    *   No more tests needed because they should be validated by PHP developers
    */
    }


/**
*  Test invalid results
*/
    public function testInvalidResults(): void
    {
        $this->assertFalse(
            Validation::string()->email()->check('')
            || Validation::string()->email()->check('test@.exam.ple.com')
            || Validation::string()->email()->check('test@ö.ple.com')
            || Validation::string()->email()->check(null)
            || Validation::string()->email()->check([])
            || Validation::string()->email()->checkAll(['ok', 'no-mail'])
            || Validation::string()->email()->check(new stdClass())
        );
        $this->assertFalse(
            Validation::create([
                'type' => 'string',
                'email' => false  // require non-email string
            ])
            ->check('test@abc.com')
        );
    }
}
