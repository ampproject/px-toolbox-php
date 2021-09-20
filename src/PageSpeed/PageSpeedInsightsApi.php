<?php

namespace PageExperience\PageSpeed;

use AmpProject\RemoteGetRequest;
use AmpProject\RemoteRequest\CurlRemoteGetRequest;
use RuntimeException;

/**
 * PageSpeed Insights API abstraction.
 *
 * @package ampproject/px-toolbox
 */
final class PageSpeedInsightsApi
{

    /**
     * PageSpeed Insights API endpoint URL.
     *
     * @var string
     */
    const API_ENDPOINT = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed';

    /**
     * Authentication key to use for the PageSpeed Insights API.
     *
     * @var string
     */
    private $key;

    /**
     * Remote GET request instance to use.
     *
     * @var RemoteGetRequest
     */
    private $remoteGetRequest;

    /**
     * Instantiate a PageSpeedInsightsApi object.
     *
     * @param string           $key              Authentication key to use for the PageSpeed Insights API.
     * @param RemoteGetRequest $remoteGetRequest Optional. Remote GET Request instance to use. Defaults to using cURL.
     */
    public function __construct($key, RemoteGetRequest $remoteGetRequest = null)
    {
        $this->key = $key;
        $this->remoteGetRequest = $remoteGetRequest ?: new CurlRemoteGetRequest(true, 60);
    }

    /**
     * Trigger an audit for a requested URL.
     *
     * @param string $url      URL for which to trigger the audit.
     * @param string $strategy Optional. Audit strategy to use. Can be 'mobile' or 'desktop'. Defaults to 'mobile'.
     * @param string $referrer Optional. Referrer that is requesting the audit. Defaults to an empty string.
     *
     * @return array Associative array of audit data.
     *
     * @throws RuntimeException If the remote request did not produce a successful result.
     */
    public function audit($url, $strategy = 'mobile', $referrer = '')
    {
        $query = sprintf(
            '%s?url=%s&key=%s&strategy=%s',
            self::API_ENDPOINT,
            urlencode($url),
            urlencode($this->key),
            urlencode($strategy)
        );

        $headers = [];

        if (! empty($referrer)) {
            $headers = ['Referer' => $referrer];
        }

        $response = $this->remoteGetRequest->get($query, $headers);

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            $message = "Failed to fetch remote audit results";

            $result = json_decode($response->getBody(), true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $message .= " ({$result['error']['code']} - {$result['error']['message']})";
            } else {
                $message .= " ({$response->getStatusCode()})";
            }

            throw new RuntimeException($message);
        }

        return json_decode($response->getBody(), true);
    }
}
