<?php

namespace PageExperience\Tests\Engine\Dsl;

use PageExperience\Engine\Dsl\Stack;
use PageExperience\Tests\TestCase;

/**
 * Test the Stack class.
 *
 * @package ampproject/px-toolbox-php
 */
final class StackTest extends TestCase
{
    /**
     * Test the class instance.
     */
    public function testItCanBeInstantiated()
    {
        $stack = new Stack();

        self::assertInstanceOf(Stack::class, $stack);
    }

    public function testItCanAcceptInput()
    {
        $stack = new Stack();

        self::assertEquals([], $stack->getInput());

        $stack->addToInput(['a' => 1]);

        self::assertEquals(['a' => 1], $stack->getInput());

        $stack->addToInput(['b' => 2]);

        self::assertEquals(['a' => 1, 'b' => 2], $stack->getInput());

        $stack->setInput(['a' => 1]);

        self::assertEquals(['a' => 1], $stack->getInput());
    }

    public function testItCanAcceptOutput()
    {
        $stack = new Stack();

        self::assertEquals([], $stack->getOutput());

        $stack->addToOutput(['a' => 1]);

        self::assertEquals(['a' => 1], $stack->getOutput());

        $stack->addToOutput(['b' => 2]);

        self::assertEquals(['a' => 1, 'b' => 2], $stack->getOutput());

        $stack->setOutput(['a' => 1]);

        self::assertEquals(['a' => 1], $stack->getOutput());
    }
}
