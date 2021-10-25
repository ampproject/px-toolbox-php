<?php

namespace PageExperience\Tests\Engine\Tool;

use PageExperience\Engine\Tool\AmpOptimizer;
use PageExperience\Tests\TestCase;

/**
 * Test the AmpOptimizer class.
 *
 * @package ampproject/px-toolbox-php
 */
final class AmpOptimizerTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $ampOptimizer = new AmpOptimizer();

        self::assertInstanceOf(AmpOptimizer::class, $ampOptimizer);
    }
}
