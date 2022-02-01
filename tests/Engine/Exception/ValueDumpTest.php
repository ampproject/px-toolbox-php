<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Engine\Exception\ValueDump;
use PageExperience\Tests\TestCase;

/**
 * Test the ValueDump class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ValueDumpTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $valueDump = new ValueDump('abc');

        self::assertInstanceOf(ValueDump::class, $valueDump);
    }

    public function dataItCanDumpValues()
    {
        return [
            'boolean true'  => [true, '(bool) true'],
            'boolean false' => [false, '(bool) false'],
            'integer'       => [123, '(int) 123'],
            'float'         => [123.456, '(float) 123.456'],
            'array'         => [[1, 2, 3], 'array(3)'],
            'object'        => [new ValueDump(123), '(object) PageExperience\Engine\Exception\ValueDump'],
            'null'          => [null, 'null'],
        ];
    }

    /**
     * @dataProvider dataItCanDumpValues()
     */
    public function testItCanDumpValues($value, $expected)
    {
        $valueDump = new ValueDump($value);

        self::assertEquals($expected, (string)$valueDump);
    }
}
