<?php

namespace PageExperience\Tests\Engine\Exception;

use PageExperience\Engine\Exception\ToolRulesetMismatch;
use PageExperience\Engine\Tool\AmpOptimizer;
use PageExperience\Engine\Tool\AmpValidator;
use PageExperience\Tests\TestCase;

/**
 * Test the ToolRulesetMismatch class.
 *
 * @package ampproject/px-toolbox-php
 */
final class ToolRulesetMismatchTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $exception = new ToolRulesetMismatch();

        self::assertInstanceOf(ToolRulesetMismatch::class, $exception);
    }

    public function testItProducesTheExpectedMessageWithoutPreviousException()
    {
        $exception = ToolRulesetMismatch::forToolWithToolRuleset(new AmpValidator(), new AmpOptimizer\Ruleset());

        self::assertEquals(
            "Could not configure tool 'amp-validator' with ruleset targeted at tool 'amp-optimizer'.",
            $exception->getMessage()
        );
    }
}
