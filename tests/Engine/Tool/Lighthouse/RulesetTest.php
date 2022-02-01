<?php

namespace PageExperience\Tests\Engine\Tool\Lighthouse;

use PageExperience\Engine\Tool\Lighthouse\Ruleset;
use PageExperience\Tests\TestCase;

/**
 * Test the Lighthouse Ruleset class.
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
