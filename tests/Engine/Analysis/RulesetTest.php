<?php

namespace PageExperience\Tests\Engine\Analysis;

use PageExperience\Engine\Analysis\Ruleset;
use PageExperience\Tests\TestCase;

/**
 * Test the Ruleset class.
 *
 * @package ampproject/px-toolbox-php
 */
final class RulesetTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $ruleset = new Ruleset('dummy');

        self::assertInstanceOf(Ruleset::class, $ruleset);
    }
}
