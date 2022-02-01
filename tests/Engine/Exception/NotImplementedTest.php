<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Engine\Exception\NotImplemented;
use PageExperience\Tests\TestCase;

/**
 * Test the NotImplemented class.
 *
 * @package ampproject/px-toolbox-php
 */
final class NotImplementedTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new NotImplemented();

        self::assertInstanceOf(NotImplemented::class, $exception);
    }

    public function testItProducesTheExpectedMessageWithoutPreviousException()
    {
        $exception = NotImplemented::forParallelOptimization();

        self::assertEquals(
            'Optimization requests on a parallel tool stack have not been implemented (yet).',
            $exception->getMessage()
        );
    }
}
