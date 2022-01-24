<?php

namespace PageExperience\Tests\Engine;

use PageExperience\Engine\Context;
use PageExperience\Tests\TestCase;

/**
 * Test the Context class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ContextTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $context = new Context();

        self::assertInstanceOf(Context::class, $context);
    }
}
