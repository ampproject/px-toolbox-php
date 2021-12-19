<?php

namespace PageExperience\Tests\Engine\Analysis;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\Analysis\PageExperienceAnalysis;
use PageExperience\Engine\Analysis\Result\Issue;
use PageExperience\Engine\Analysis\Result\Metric;
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

    public function testItCanReturnResults()
    {
        $analysis = new PageExperienceAnalysis(Status::ERROR(), Timestamp::now(), Scope::SITE(), new Ruleset('dummy'));

        $analysis->addResult(new Issue('issue1', 'Issue 1', 'First issue'));
        $analysis->addResult(new Metric('metric1', 'Metric 1', 'First metric', 60, 'seconds', '60s'));
        $analysis->addResult(new Issue('issue2', 'Issue 2', 'Second issue'));
        $analysis->addResult(new Metric('metric2', 'Metric 2', 'Second metric', 23.5, 'milliseconds', '23.5ms'));

        $results = $analysis->getResults();

        self::assertIsArray($results);
        self::assertCount(4, $results);

        self::assertInstanceOf(Issue::class, $results[0]);
        self::assertEquals('issue1', $results[0]->getId());
        self::assertEquals('Issue 1', $results[0]->getLabel());
        self::assertEquals('First issue', $results[0]->getDescription());

        self::assertInstanceOf(Metric::class, $results[1]);
        self::assertEquals('metric1', $results[1]->getId());
        self::assertEquals('Metric 1', $results[1]->getLabel());
        self::assertEquals('First metric', $results[1]->getDescription());
        self::assertEquals(60, $results[1]->getValue());
        self::assertEquals('seconds', $results[1]->getUnit());
        self::assertEquals('60s', $results[1]->getDisplayValue());

        self::assertInstanceOf(Issue::class, $results[2]);
        self::assertEquals('issue2', $results[2]->getId());
        self::assertEquals('Issue 2', $results[2]->getLabel());
        self::assertEquals('Second issue', $results[2]->getDescription());

        self::assertInstanceOf(Metric::class, $results[3]);
        self::assertEquals('metric2', $results[3]->getId());
        self::assertEquals('Metric 2', $results[3]->getLabel());
        self::assertEquals('Second metric', $results[3]->getDescription());
        self::assertEquals(23.5, $results[3]->getValue());
        self::assertEquals('milliseconds', $results[3]->getUnit());
        self::assertEquals('23.5ms', $results[3]->getDisplayValue());
    }

    public function testItCanReturnFilteredResults()
    {
        $analysis = new PageExperienceAnalysis(Status::ERROR(), Timestamp::now(), Scope::SITE(), new Ruleset('dummy'));

        $analysis->addResult(new Issue('issue1', 'Issue 1', 'First issue'));
        $analysis->addResult(new Metric('metric1', 'Metric 1', 'First metric', 60, 'seconds', '60s'));
        $analysis->addResult(new Issue('issue2', 'Issue 2', 'Second issue'));
        $analysis->addResult(new Metric('metric2', 'Metric 2', 'Second metric', 23.5, 'milliseconds', '23.5ms'));

        $results = $analysis->getResultsOfType(Metric::class);

        self::assertIsArray($results);
        self::assertCount(2, $results);

        self::assertInstanceOf(Metric::class, $results[0]);
        self::assertEquals('metric1', $results[0]->getId());
        self::assertEquals('Metric 1', $results[0]->getLabel());
        self::assertEquals('First metric', $results[0]->getDescription());
        self::assertEquals(60, $results[0]->getValue());
        self::assertEquals('seconds', $results[0]->getUnit());
        self::assertEquals('60s', $results[0]->getDisplayValue());

        self::assertInstanceOf(Metric::class, $results[1]);
        self::assertEquals('metric2', $results[1]->getId());
        self::assertEquals('Metric 2', $results[1]->getLabel());
        self::assertEquals('Second metric', $results[1]->getDescription());
        self::assertEquals(23.5, $results[1]->getValue());
        self::assertEquals('milliseconds', $results[1]->getUnit());
        self::assertEquals('23.5ms', $results[1]->getDisplayValue());
    }
}
