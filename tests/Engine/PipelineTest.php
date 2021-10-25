<?php

namespace PageExperience\Tests\Engine;

use PageExperience\Engine\Pipeline;
use PageExperience\Engine\ToolStack;
use PageExperience\Tests\TestCase;

/**
 * Test the Pipeline class.
 *
 * @package ampproject/px-toolbox-php
 */
final class PipelineTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $toolStack = $this->createMock(ToolStack::class);

        $pipeline = new Pipeline($toolStack);

        self::assertInstanceOf(Pipeline::class, $pipeline);
    }
}
