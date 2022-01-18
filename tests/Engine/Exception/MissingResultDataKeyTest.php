<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Tests\TestCase;
use PageExperience\Engine\Exception\MissingResultDataKey;

/**
 * Test the MissingResultDataKey class.
 *
 * @package ampproject/px-toolbox-php
 */
final class MissingResultDataKeyTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new MissingResultDataKey();

        self::assertInstanceOf(MissingResultDataKey::class, $exception);
    }

    public function testItProducesTheExpectedMessageForKey()
    {
        $exception = MissingResultDataKey::forKey('data_id', 'data_key');

        self::assertEquals(
            "Expected key 'data_key' is missing from provided result data set with ID 'data_id'.",
            $exception->getMessage()
        );
    }
}
