<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Engine\Exception\FailedToProcessTimestamp;
use PageExperience\Tests\TestCase;

/**
 * Test the FailedToProcessTimestamp class.
 *
 * @package ampproject/px-toolbox-php
 */
final class FailedToProcessTimestampTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new FailedToProcessTimestamp();

        self::assertInstanceOf(FailedToProcessTimestamp::class, $exception);
    }

    public function testItProducesTheExpectedMessageWithoutPreviousException()
    {
        $exception = FailedToProcessTimestamp::forDateTimeImmutableFailure('abc', 123);

        self::assertEquals(
            "Failed to instantiate a DateTimeImmutable object for timestamp '(int) 123', got '(string) abc' instead.",
            $exception->getMessage()
        );
    }
}
