<?php

namespace PageExperience\Tests\Engine\Tool;

use AmpProject\RemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool\PageSpeedInsights;
use PageExperience\Tests\ConfiguredStubbedRemoteGetRequest;
use PageExperience\Tests\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Test the PageSpeedInsights class.
 *
 * @package ampproject/px-toolbox-php
 */
final class PageSpeedInsightsTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $remoteRequestMock = $this->createMock(RemoteGetRequest::class);
        $loggerMock        = $this->createMock(LoggerInterface::class);

        $pageSpeedInsights = new PageSpeedInsights($remoteRequestMock, $loggerMock);

        self::assertInstanceOf(PageSpeedInsights::class, $pageSpeedInsights);
    }

    public function testItCanRunAnAudit()
    {
        $loggerMock        = $this->createMock(LoggerInterface::class);
        $pageSpeedInsights = new PageSpeedInsights(ConfiguredStubbedRemoteGetRequest::create(), $loggerMock);

        $analysis = $this->createMock(Analysis::class);
        $profile  = new ConfigurationProfile();
        $context  = new Context();

        $ruleset = PageSpeedInsights\Ruleset::fromProfile($profile);
        $pageSpeedInsights->configureWithRuleset($ruleset);

        $analysis = $pageSpeedInsights->analyze($analysis, 'https://amp-wp.org', $profile, $context);
        $this->assertInstanceOf(Analysis::class, $analysis);
    }
}
