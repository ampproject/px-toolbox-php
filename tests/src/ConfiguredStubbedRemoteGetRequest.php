<?php

namespace PageExperience\Tests;

use AmpProject\RemoteRequest\StubbedRemoteGetRequest;

/**
 * Creates a fully configured stubbed remote request handler for use in tests.
 *
 * @package ampproject/px-toolbox
 */
final class ConfiguredStubbedRemoteGetRequest
{

    /**
     * URL to the PageSpeed Insights API root.
     *
     * @var string
     */
    const PSI_ROOT = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed';

    /**
     * Filepath to the PageSpeed Insights API response fixture.
     *
     * @var string
     */
    const FIXTURE_FILEPATH = __DIR__ . '/../fixtures/psi_amp-wp.org.json';

    /**
     * Create a fully configured StubbedRemoteGetRequest instance.
     *
     * @returns StubbedRemoteGetRequest Fully configured StubbedRemoteGetRequest instance.
     */
    public static function create()
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

        return new StubbedRemoteGetRequest($argumentMap);
    }
}
