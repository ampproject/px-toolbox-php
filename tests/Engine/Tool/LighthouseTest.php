<?php

namespace PageExperience\Tests\Engine\Tool;

use AmpProject\RemoteGetRequest;
use AmpProject\RemoteRequest\StubbedRemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool\Lighthouse;
use PageExperience\Tests\ConfiguredStubbedRemoteGetRequest;
use PageExperience\Tests\TestCase;

/**
 * Test the Lighthouse class.
 *
 * @package ampproject/px-toolbox-php
 */
final class LighthouseTest extends TestCase
{

    public function testItCanBeInstantiated()
    {
        $remoteRequestMock = $this->createMock(RemoteGetRequest::class);

        $lighthouse = new Lighthouse($remoteRequestMock);

        self::assertInstanceOf(Lighthouse::class, $lighthouse);
    }

    public function testItCanRunAnAudit()
    {
        $lighthouse = new Lighthouse(ConfiguredStubbedRemoteGetRequest::create());

        $analysis = $this->createMock(Analysis::class);
        $profile  = new ConfigurationProfile();
        $context  = new Context();

        $ruleset = Lighthouse\Ruleset::fromProfile($profile);
        $lighthouse->configureWithRuleset($ruleset);

        $analysis = $lighthouse->analyze($analysis, 'https://amp-wp.org', $profile, $context);

        $this->assertInstanceOf(Analysis::class, $analysis);
    }
}
