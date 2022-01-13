<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Tests\TestCase;
use PageExperience\Engine\Exception\InvalidTool;

/**
 * Test the InvalidTool class.
 *
 * @package ampproject/px-toolbox-php
 */
final class InvalidToolTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new InvalidTool();

        self::assertInstanceOf(InvalidTool::class, $exception);
    }

    public function testItProducesTheExpectedMessageForBadFqcn()
    {
        $exception = InvalidTool::forBadFqcn('\Foo\Bar');

        self::assertEquals(
            "FQCN provided does not implement the \PageExperience\Engine\Tool interface: '\Foo\Bar'.",
            $exception->getMessage()
        );
    }

    public function testItProducesTheExpectedMessageForBadObject()
    {
        $exception = InvalidTool::forBadObject('bad_tool');

        self::assertEquals(
            'Instantiated tool object does not implement the \PageExperience\Engine\Tool interface: (string) bad_tool',
            $exception->getMessage()
        );
    }
}
