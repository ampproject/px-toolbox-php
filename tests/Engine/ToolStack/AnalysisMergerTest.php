<?php

namespace PageExperience\Tests\Engine\ToolStack;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\ToolStack\AnalysisMerger;
use PageExperience\Tests\TestCase;

/**
 * Test the AnalysisMerger class.
 *
 * @package ampproject/px-toolbox-php
 */
final class AnalysisMergerTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $toolStack = $this->createMock(Analysis::class);

        $analysisMerger = new AnalysisMerger($toolStack);

        self::assertInstanceOf(AnalysisMerger::class, $analysisMerger);
    }
}
