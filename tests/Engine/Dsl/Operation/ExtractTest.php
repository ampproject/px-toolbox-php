<?php

namespace PageExperience\Tests\Engine\Dsl\Operation;

use PageExperience\Engine\Dsl\Operation\Extract;
use PageExperience\Engine\Dsl\Stack;
use PageExperience\Tests\TestCase;

/**
 * Test the Extract class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ExtractTest extends TestCase
{
    /**
     * Test the class instance.
     */
    public function testItCanBeInstantiated()
    {
        $extractOperation = new Extract([], []);

        self::assertInstanceOf(Extract::class, $extractOperation);
    }

    public function dataItCanProcess()
    {
        return [
            [[], [], []],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['a'], ['b' => ['c' => 1]]],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['a.b'], ['c' => 1]],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['d'], ['e' => ['f' => 2]]],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['a', 'd'], ['b' => ['c' => 1], 'e' => ['f' => 2]]],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['a.b', 'd'], ['c' => 1, 'e' => ['f' => 2]]],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['a.b', 'd.e'], ['c' => 1, 'f' => 2]],
        ];
    }

    /**
     * @dataProvider dataItCanProcess
     * @param array $data Initial data.
     * @param array $keys Keys to extract.
     * @return void
     */
    public function testItCanProcess($data, $keys, $expectedInput)
    {
        $extractOperation = new Extract($data, $keys);
        $stack            = new Stack();

        $extractOperation->process($stack);

        self::assertEquals($expectedInput, $stack->getInput());
    }
}
