<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Engine\Exception\InvalidRenderer;
use PageExperience\Tests\TestCase;

/**
 * Test the InvalidRenderer class.
 *
 * @package ampproject/px-toolbox-php
 */
final class InvalidRendererTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $exception = new InvalidRenderer();

        self::assertInstanceOf(InvalidRenderer::class, $exception);
    }

    public function testItProducesTheExpectedMessageWithoutPreviousException()
    {
        $exception = InvalidRenderer::forRenderer('dummy-renderer');

        self::assertEquals("Invalid renderer requested: 'dummy-renderer'.", $exception->getMessage());
    }
}
