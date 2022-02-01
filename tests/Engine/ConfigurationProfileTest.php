<?php

namespace PageExperience\Tests\Engine;

use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Tests\TestCase;

/**
 * Test the ConfigurationProfile class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ConfigurationProfileTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $profile = new ConfigurationProfile();

        self::assertInstanceOf(ConfigurationProfile::class, $profile);
    }
}
