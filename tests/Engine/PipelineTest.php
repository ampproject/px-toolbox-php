<?php

namespace PageExperience\Tests\Engine;

use PageExperience\Engine\ConfigurationProfile;
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
        $profile   = new ConfigurationProfile();
        $toolStack = $this->createMock(ToolStack::class);

        $pipeline = new Pipeline($toolStack, $profile);

        self::assertInstanceOf(Pipeline::class, $pipeline);
    }
}
