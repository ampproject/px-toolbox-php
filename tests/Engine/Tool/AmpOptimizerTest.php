<?php

namespace PageExperience\Tests\Engine\Tool;

use AmpProject\RemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool\AmpOptimizer;
use PageExperience\Tests\ConfiguredStubbedRemoteGetRequest;
use PageExperience\Tests\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Test the AmpOptimizer class.
 *
 * @package ampproject/px-toolbox-php
 */
final class AmpOptimizerTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $remoteGetRequestMock = $this->createMock(RemoteGetRequest::class);
        $loggerMock           = $this->createMock(LoggerInterface::class);

        $ampOptimizer = new AmpOptimizer($remoteGetRequestMock, $loggerMock);

        self::assertInstanceOf(AmpOptimizer::class, $ampOptimizer);
    }

    public function testItCanOptimizeHtml()
    {
        $remoteGetRequest = ConfiguredStubbedRemoteGetRequest::create();
        $loggerMock       = $this->createMock(LoggerInterface::class);
        $analysisMock     = $this->createMock(Analysis::class);
        $profile          = new ConfigurationProfile();
        $context          = new Context();

        $ampOptimizer = new AmpOptimizer($remoteGetRequest, $loggerMock);

        $ruleset = AmpOptimizer\Ruleset::fromProfile($profile);
        $ampOptimizer->configureWithRuleset($ruleset);

        $optimizedHtml = $ampOptimizer->optimizeHtml($analysisMock, '<html amp></html>', $profile, $context);

        $this->assertStringContainsString('<html', $optimizedHtml);
        $this->assertStringContainsString('transformed="self;v=1"', $optimizedHtml);
    }
}
