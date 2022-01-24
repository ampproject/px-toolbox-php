<?php

namespace PageExperience\Tests\Engine\Tool;

use AmpProject\RemoteGetRequest;
use AmpProject\RemoteRequest\StubbedRemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool\AmpOptimizer;
use PageExperience\Tests\ConfiguredStubbedRemoteGetRequest;
use PageExperience\Tests\TestCase;

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

        $ampOptimizer = new AmpOptimizer($remoteGetRequestMock);

        self::assertInstanceOf(AmpOptimizer::class, $ampOptimizer);
    }

    public function testItCanOptimizeHtml()
    {
        $remoteGetRequest = ConfiguredStubbedRemoteGetRequest::create();
        $analysisMock     = $this->createMock(Analysis::class);
        $profile          = new ConfigurationProfile();
        $context          = new Context();

        $ampOptimizer = new AmpOptimizer($remoteGetRequest);

        $ruleset = AmpOptimizer\Ruleset::fromProfile($profile);
        $ampOptimizer->configureWithRuleset($ruleset);

        $optimizedHtml = $ampOptimizer->optimizeHtml($analysisMock, '<html amp></html>', $profile, $context);

        $this->assertStringContainsString('<html', $optimizedHtml);
        $this->assertStringContainsString('transformed="self;v=1"', $optimizedHtml);
    }
}
