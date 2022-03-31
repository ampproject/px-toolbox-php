<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\ToolStack\DefaultToolStackFactory;
use PageExperience\Engine\ToolStack\ToolStackConfiguration;
use PageExperience\Tests\TestCase;
use Psr\Log\LoggerInterface;

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
        $loggerMock             = $this->createMock(LoggerInterface::class);

        $toolStackFactory = new DefaultToolStackFactory($toolStackConfiguration, $loggerMock);

        self::assertInstanceOf(DefaultToolStackFactory::class, $toolStackFactory);
    }
}
