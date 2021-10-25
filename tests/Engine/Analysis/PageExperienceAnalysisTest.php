<?php

namespace PageExperience\Tests\Engine\Analysis;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\Analysis\PageExperienceAnalysis;
use PageExperience\Engine\Analysis\Ruleset;
use PageExperience\Engine\Analysis\Scope;
use PageExperience\Engine\Analysis\Status;
use PageExperience\Engine\Analysis\Timestamp;
use PageExperience\Tests\TestCase;

/**
 * Test the PageExperienceAnalysis class.
 *
 * @package ampproject/px-toolbox-php
 */
final class PageExperienceAnalysisTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $analysis = new PageExperienceAnalysis(Status::ERROR(), Timestamp::now(), Scope::SITE(), new Ruleset('dummy'));

        self::assertInstanceOf(Analysis::class, $analysis);
        self::assertInstanceOf(PageExperienceAnalysis::class, $analysis);
    }
}
