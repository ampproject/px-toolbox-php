<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Tests\TestCase;
use PageExperience\Engine\Exception\InvalidToolStackConfiguration;

/**
 * Test the InvalidToolStackConfiguration class.
 *
 * @package ampproject/px-toolbox-php
 */
final class InvalidToolStackConfigurationTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new InvalidToolStackConfiguration();

        self::assertInstanceOf(InvalidToolStackConfiguration::class, $exception);
    }
}
