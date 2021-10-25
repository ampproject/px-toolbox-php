<?php

namespace PageExperience\Tests\Engine\Tool;

use PageExperience\Engine\Tool\Lighthouse;
use PageExperience\Tests\TestCase;

/**
 * Test the Lighthouse class.
 *
 * @package ampproject/px-toolbox-php
 */
final class LighthouseTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $lighthouse = new Lighthouse();

        self::assertInstanceOf(Lighthouse::class, $lighthouse);
    }
}
