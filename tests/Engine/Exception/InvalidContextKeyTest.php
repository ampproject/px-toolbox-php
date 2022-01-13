<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Tests\TestCase;
use PageExperience\Engine\Exception\InvalidContextKey;

/**
 * Test the InvalidContextKey class.
 *
 * @package ampproject/px-toolbox-php
 */
final class InvalidContextKeyTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new InvalidContextKey();

        self::assertInstanceOf(InvalidContextKey::class, $exception);
    }

    public function testItProducesTheExpectedMessageWithoutPreviousException()
    {
        $exception = InvalidContextKey::forContextKey('TEST_CONTEXT_KEY');

        self::assertEquals(
            "Invalid context key requested: 'TEST_CONTEXT_KEY'.",
            $exception->getMessage()
        );
    }
}
