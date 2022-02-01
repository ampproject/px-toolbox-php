<?php

namespace PageExperience\Tests\Engine\Tool\AmpOptimizer;

use PageExperience\Engine\Tool\AmpOptimizer\Ruleset;
use PageExperience\Tests\TestCase;

/**
 * Test the AmpOptimizer Ruleset class.
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
