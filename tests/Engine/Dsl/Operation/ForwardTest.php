<?php

namespace PageExperience\Tests\Engine\Dsl\Operation;

use PageExperience\Engine\Dsl\Operation\Forward;
use PageExperience\Engine\Dsl\Stack;
use PageExperience\Tests\TestCase;

/**
 * Test the Forward class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ForwardTest extends TestCase
{
    /**
     * Test the class instance.
     */
    public function testItCanBeInstantiated()
    {
        $forwardOperation = new Forward([]);

        self::assertInstanceOf(Forward::class, $forwardOperation);
    }

    public function dataItCanProcess()
    {
        return [
            [[], [], []],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['a'], ['a' => ['b' => ['c' => 1]]]],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['d'], ['d' => ['e' => ['f' => 2]]]],
            [['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]], ['a', 'd'], ['a' => ['b' => ['c' => 1]], 'd' => ['e' => ['f' => 2]]]],
        ];
    }

    /**
     * @dataProvider dataItCanProcess
     * @param array $input Stack input.
     * @param array $keys  Keys to forward.
     * @return void
     */
    public function testItCanProcess($input, $keys, $expectedOutput)
    {
        $forwardOperation = new Forward($keys);
        $stack            = new Stack();
        $stack->setInput($input);

        $forwardOperation->process([], $stack);

        self::assertEquals($expectedOutput, $stack->getOutput());
    }
}
