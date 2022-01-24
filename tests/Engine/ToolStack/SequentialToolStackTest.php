<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\Tool;
use PageExperience\Engine\ToolStack\SequentialToolStack;
use PageExperience\Tests\TestCase;

/**
 * Test the SequentialToolStack class.
 *
 * @package ampproject/px-toolbox-php
 */
final class SequentialToolStackTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $toolA = $this->createMock(Tool::class);
        $toolB = $this->createMock(Tool::class);

        $parallelToolStack = new SequentialToolStack($toolA, $toolB);

        self::assertInstanceOf(SequentialToolStack::class, $parallelToolStack);
    }
}
