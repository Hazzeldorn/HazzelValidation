<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;

final class ValidationTest extends TestCase
{




   /**
   *  Test constructor methods
   */
    public function testConstructorMethods(): void
    {
        $this->assertInstanceOf(Validation::class, Validation::create());
        $this->assertInstanceOf(Validation::class, Validation::string());
        $this->assertInstanceOf(Validation::class, Validation::int());
        $this->assertInstanceOf(Validation::class, Validation::integer());
        $this->assertInstanceOf(Validation::class, Validation::number());
    }


   /**
   *  Test reusability
   */
    public function testReusability(): void
    {
        $emailValidator = Validation::create([
           'type' => 'string',
           'email' => true
        ]);
        $this->assertTrue($emailValidator->check('test@example.com'));
        $this->assertFalse($emailValidator->check('no-email'));
    }
}
