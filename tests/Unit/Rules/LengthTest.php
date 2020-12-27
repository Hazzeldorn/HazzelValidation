<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;
use InvalidArgumentException;

final class LengthTest extends TestCase
{




   /**
   *  Test valid results
   */
    public function testValidResults(): void
    {
        $this->assertTrue(
            Validation::string()->length(0)->check('')
            && Validation::string()->length(4)->check('test')
            && Validation::string()->length(4, 4)->check('test')
            && Validation::string()->length(3, 5)->check('test')
            && Validation::string()->length(3, 5, false)->check('test')
            && Validation::string()->length(null, 5)->check('ok')
            && Validation::string()->length(3, null)->check('loooong string')
            && Validation::create()->length(3)->check(111)
            && Validation::create()->length(10)->check(range(1, 10))
            && Validation::create()->length(2)->check(['foo', 'bar'])
            && Validation::create()->length(1)->check((object) ['firstname' => 'mike'])
        );
    }


   /**
   *  Test invalid results
   */
    public function testInvalidResults(): void
    {
        $this->assertFalse(
            Validation::string()->length(1)->check('test')
            || Validation::string()->length(4, 4, false)->check('test')
            || Validation::string()->length(3, 4, false)->check('test')
            || Validation::string()->length(4, 5, false)->check('test')
            || Validation::create()->length(3)->check(111111)
            || Validation::create()->length(10)->check(range(1, 15))
            || Validation::create()->length(2)->check((object) ['firstname' => 'mike'])
        );
    }


   /**
   *  Test setting array instead of method chaining
   */
    public function testSettingsArray(): void
    {
        $this->assertTrue(
            Validation::create([
               'type' => 'string',
               'length' => [3, 5]
            ])
            ->check('test')
        );
        $this->assertFalse(
            Validation::create([
               'type' => 'string',
               'length' => 1
            ])
            ->check('test')
        );
    }


   /**
   *  Test exception case -> min and max values are in the wrong order
   */
    public function testMinAndMaxInWrongOrder(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Validation::string()->length(10, 5)->check('test');
    }

   /**
   *  Test exception case -> negative value is not allowed
   */
    public function testNegativeValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Validation::string()->length(-1)->check('');
    }
}
