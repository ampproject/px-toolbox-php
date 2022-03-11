<?php

namespace PageExperience\Tests\Engine\Tool\PageSpeedInsights;

use PageExperience\Engine\Tool\PageSpeedInsights\Ruleset;
use PageExperience\Tests\TestCase;

/**
 * Test the PageSpeedInsights Ruleset class.
 *
 * @package ampproject/px-toolbox-php
 */
final class RulesetTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $ruleset = new Ruleset();

        self::assertInstanceOf(Ruleset::class, $ruleset);
    }
}
