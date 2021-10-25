<?php

namespace PageExperience\Tests\Engine\Tool\AmpValidator;

use PageExperience\Engine\Tool\AmpValidator\Ruleset;
use PageExperience\Tests\TestCase;

/**
 * Test the AmpValidator Ruleset class.
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
