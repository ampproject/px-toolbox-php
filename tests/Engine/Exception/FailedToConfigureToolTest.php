<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Engine\Exception\FailedToConfigureTool;
use PageExperience\Tests\TestCase;
use RuntimeException;

/**
 * Test the FailedToConfigureTool class.
 *
 * @package ampproject/px-toolbox-php
 */
final class FailedToConfigureToolTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new FailedToConfigureTool();

        self::assertInstanceOf(FailedToConfigureTool::class, $exception);
    }

    public function testItProducesTheExpectedMessageWithoutPreviousException()
    {
        $exception = FailedToConfigureTool::forTool('test-tool');

        self::assertEquals("Failed to configure page experience tool 'test-tool'.", $exception->getMessage());
    }

    public function testItProducesTheExpectedMessageWithPreviousException()
    {
        $previous  = new RuntimeException('PREVIOUS_EXCEPTION');
        $exception = FailedToConfigureTool::forTool('test-tool', $previous);

        self::assertEquals(
            "Failed to configure page experience tool 'test-tool'. Reason: PREVIOUS_EXCEPTION",
            $exception->getMessage()
        );
    }
}
