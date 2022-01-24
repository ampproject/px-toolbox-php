<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\Tool;
use PageExperience\Engine\ToolStack\ParallelToolStack;
use PageExperience\Tests\TestCase;

/**
 * Test the ParallelToolStack class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ParallelToolStackTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $toolA = $this->createMock(Tool::class);
        $toolB = $this->createMock(Tool::class);

        $parallelToolStack = new ParallelToolStack($toolA, $toolB);

        self::assertInstanceOf(ParallelToolStack::class, $parallelToolStack);
    }
}
