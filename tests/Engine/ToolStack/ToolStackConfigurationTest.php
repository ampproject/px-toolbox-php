<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\ToolStack\ToolStackConfiguration;
use PageExperience\Tests\TestCase;

/**
 * Test the ToolStackConfiguration class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ToolStackConfigurationTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $toolStackConfiguration = new ToolStackConfiguration();

        self::assertInstanceOf(ToolStackConfiguration::class, $toolStackConfiguration);
    }
}
