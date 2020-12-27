<?php

declare(strict_types=1);

namespace HazzelValidation;

use PHPUnit\Framework\TestCase;
use HazzelValidation\Validation as Validation;
use stdClass;
use ArrayObject;
use ArrayIterator;

final class TypeTest extends TestCase
{


    /**
    *  STRING
    *  Test valid results
    */
    public function testValidStrings(): void
    {
        $this->assertTrue(
            Validation::create()->string()->check('test')
            && Validation::string()->check('+*2')
            && Validation::string()->check(' ')
            && Validation::string()->check('')
            && Validation::string()->check(str_repeat('aaaaaaaaaa', 1000))
        );
    }


    /**
    *  STRING
    *  Test invalid results
    */
    public function testInvalidStrings(): void
    {
        $this->assertFalse(
            Validation::string()->check(1)
            || Validation::string()->check(NAN)
            || Validation::string()->check(true)
            || Validation::string()->check(false)
            || Validation::string()->check(null)
            || Validation::string()->check(PHP_INT_MAX)
            || Validation::string()->check([])
            || Validation::string()->check(new stdClass())
        );
    }



    /**
    *  BOOLEAN
    *  Test valid results
    */
    public function testValidBoolean(): void
    {
        $this->assertTrue(
            Validation::create()->bool()->check(true)
            && Validation::boolean()->check(false)
            && Validation::boolean()->check((bool) 1)
            && Validation::boolean()->check((bool) 0)
        );
    }


    /**
    *  BOOLEAN
    *  Test invalid results
    */
    public function testInvalidBoolean(): void
    {
        $this->assertFalse(
            Validation::boolean()->check('')
            || Validation::boolean()->check('test')
            || Validation::boolean()->check(123)
            || Validation::boolean()->check(1) // not boolean type
            || Validation::bool()->check(0) // not boolean type
            || Validation::bool()->check([])
            || Validation::bool()->check(new stdClass())
        );
    }

    /**
    *  NUMBER
    *  Test valid results
    */
    public function testValidNumbers(): void
    {
        $this->assertTrue(
            Validation::create()->number()->check(123)
            && Validation::number()->check('123')
            && Validation::number()->check(0.00000000001)
            && Validation::number()->check(0.5)
            && Validation::number()->check(-0.5)
            && Validation::number()->check('-0.5')
            && Validation::number()->check(PHP_INT_MAX)
            && Validation::number()->check(-PHP_INT_MAX)
            && Validation::number()->check(INF)
            && Validation::number()->check(-INF)
        );
    }


    /**
    *  NUMBER
    *  Test invalid results
    */
    public function testInvalidNumbers(): void
    {
        $this->assertFalse(
            Validation::number()->check('test')
            || Validation::number()->check(acos(1.01))
            || Validation::number()->check(sqrt(-1))
            || Validation::number()->check(NAN)
            || Validation::number()->check(true)
            || Validation::number()->check(false)
            || Validation::number()->check([])
            || Validation::number()->check(new stdClass())
        );
    }

    /**
    *  INT
    *  Test valid results
    */
    public function testValidInteger(): void
    {
        $this->assertTrue(
            Validation::create()->int()->check(123)
            && Validation::integer()->check(123)
            && Validation::int()->check(0)
            && Validation::int()->check(-1)
            && Validation::int()->check(PHP_INT_MAX)
            && Validation::int()->check(-PHP_INT_MAX)
        );
    }


    /**
    *  INT
    *  Test invalid results
    */
    public function testInvalidInteger(): void
    {
        $this->assertFalse(
            Validation::int()->check('test')
            || Validation::int()->check(acos(1.01))
            || Validation::int()->check(sqrt(-1))
            || Validation::int()->check(0.5)
            || Validation::int()->check(NAN)
            || Validation::int()->check(true)
        );
    }


    /**
    *  FLOAT
    *  Test valid results
    */
    public function testValidFloat(): void
    {
        $this->assertTrue(
            Validation::create()->float()->check(123.5)
            && Validation::float()->check(1.3e3)
            && Validation::float()->check(7E-10)
            && Validation::float()->check(0.00)
            && Validation::float()->check(10 / 33.33)
            && Validation::float()->check(PHP_INT_MAX + 1)
        );
    }


    /**
    *  FLOAT
    *  Test invalid results
    */
    public function testInvalidFloat(): void
    {
        $this->assertFalse(
            Validation::float()->check('test')
            || Validation::float()->check('1.0')
            || Validation::float()->check(123)
            || Validation::float()->check(PHP_INT_MAX * -1)
        );
    }

    /**
    *  ARRAY
    *  Test valid results
    */
    public function testValidArray(): void
    {
        $this->assertTrue(
            Validation::create()->array()->check([])
            && Validation::array()->check([1])
            && Validation::array()->check([1, 2, 3])
        );
    }


    /**
    *  ARRAY
    *  Test invalid results
    */
    public function testInvalidArray(): void
    {
        $this->assertFalse(
            Validation::array()->check('test')
            || Validation::array()->check(1.0)
            || Validation::array()->check(true)
            || Validation::array()->check(new ArrayObject())
            || Validation::array()->check(new ArrayIterator())
        );
    }

    /**
    *  OBJECT
    *  Test valid results
    */
    public function testValidObject(): void
    {
        $this->assertTrue(
            Validation::create()->object()->check(new stdClass())
            && Validation::object()->check(new ArrayObject())
        );
    }


    /**
    *  OBJECT
    *  Test invalid results
    */
    public function testInvalidObject(): void
    {
        $this->assertFalse(
            Validation::object()->check('test')
            || Validation::object()->check('')
            || Validation::object()->check(null)
            || Validation::object()->check(123)
            || Validation::object()->check([])
            || Validation::object()->check(true)
            || Validation::object()->check(false)
        );
    }
}
