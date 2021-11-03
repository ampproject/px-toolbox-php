<?php

namespace PageExperience\Tests\Engine\Tool;

use AmpProject\RemoteGetRequest;
use AmpProject\RemoteRequest\StubbedRemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool\Lighthouse;
use PageExperience\Tests\TestCase;

/**
 * Test the Lighthouse class.
 *
 * @package ampproject/px-toolbox-php
 */
final class LighthouseTest extends TestCase
{
    const PSI_ROOT = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed';
    const FIXTURE_FILEPATH = __DIR__ . '/../../fixtures/psi_amp-wp.org.json';

    public function testItCanBeInstantiated()
    {
        $remoteRequestMock = $this->createMock(RemoteGetRequest::class);

        $lighthouse = new Lighthouse($remoteRequestMock);

        self::assertInstanceOf(Lighthouse::class, $lighthouse);
    }

    public function testItCanRunAnAudit()
    {
        $url   = 'https://amp-wp.org';
        $query = sprintf(
            '%s?url=%s&key=%s&strategy=%s',
            self::PSI_ROOT,
            rawurlencode($url),
            '123',
            'mobile'
        );

        $argumentMap = [
            $query => file_get_contents(self::FIXTURE_FILEPATH)
        ];

        $stubbedRemoteRequest = new StubbedRemoteGetRequest($argumentMap);
        $lighthouse           = new Lighthouse($stubbedRemoteRequest);

        $analysis = $this->createMock(Analysis::class);
        $profile  = new ConfigurationProfile();
        $context  = new Context();

        $ruleset = Lighthouse\Ruleset::fromProfile($profile);
        $lighthouse->configureWithRuleset($ruleset);

        $analysis = $lighthouse->analyze($analysis, $url, $profile, $context);

        $this->assertInstanceOf(Analysis::class, $analysis);
    }
}
