<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\Context;
use PageExperience\Engine\ToolStack\ContextMerger;
use PageExperience\Tests\TestCase;

/**
 * Test the ContextMerger class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ContextMergerTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $context = new Context();

        $contextMerger = new ContextMerger($context);

        self::assertInstanceOf(ContextMerger::class, $contextMerger);
    }
}
