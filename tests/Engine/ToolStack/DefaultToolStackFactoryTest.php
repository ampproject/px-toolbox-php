<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\ToolStack\DefaultToolStackFactory;
use PageExperience\Engine\ToolStack\ToolStackConfiguration;
use PageExperience\Tests\TestCase;

/**
 * Test the DefaultToolStackFactory class.
 *
 * @package ampproject/px-toolbox-php
 */
final class DefaultToolStackFactoryTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $toolStackConfiguration = new ToolStackConfiguration();

        $toolStackFactory = new DefaultToolStackFactory($toolStackConfiguration);

        self::assertInstanceOf(DefaultToolStackFactory::class, $toolStackFactory);
    }
}
