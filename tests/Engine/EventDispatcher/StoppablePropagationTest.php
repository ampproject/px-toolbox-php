<?php

namespace PageExperience\Tests\Engine\EventDispatcher;

use PageExperience\Tests\TestCase;
use PageExperience\Engine\EventDispatcher\StoppablePropagation;

/**
 * Test the StoppablePropagationTest class.
 *
 * @package ampproject/px-toolbox-php
 */
final class StoppablePropagationTest extends TestCase
{
    /**
     * Test propagation status.
     */
    public function testPropagationStatus()
    {
        /** @var StoppablePropagation **/
        $mock = $this->getMockForTrait(StoppablePropagation::class);

        self::assertFalse($mock->isPropagationStopped());

        $mock->stopPropagation();
        self::assertTrue($mock->isPropagationStopped());
    }
}
