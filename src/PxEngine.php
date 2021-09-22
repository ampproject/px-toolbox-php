<?php

namespace PageExperience;

use Psr\Http\Message\ResponseInterface;

/**
 * Page experience engine.
 *
 * @package ampproject/px-toolbox
 */
final class PxEngine
{

    /**
     * Analyze a URL.
     *
     * @param string               $url     URL to run an analysis for.
     * @param ConfigurationProfile $profile Configuration profile to use for the analysis.
     * @return Analysis Page experience analysis.
     */
    public function analyze($url, ConfigurationProfile $profile)
    {
        return new Analysis\PageExperienceAnalysis(
            Analysis\Status::SUCCESS(),
            new \DateTimeImmutable(),
            Analysis\Scope::PAGE(),
            new Analysis\Ruleset('L1')
        );
    }

    /**
     * Optimize a string of HTML.
     *
     * @param string               $html    String of HTML to optimize.
     * @param ConfigurationProfile $profile Configuration profile to use for the optimization.
     * @return string String of optimized HTML.
     */
    public function optimizeHtml($html, ConfigurationProfile $profile)
    {
        return '';
    }

    /**
     * Optimize an HTTP response.
     *
     * @param ResponseInterface    $response HTTP response to optimize.
     * @param ConfigurationProfile $profile  Configuration profile to use for the optimization.
     * @return ResponseInterface Optimized HTTP response.
     */
    public function optimizeResponse(ResponseInterface $response, ConfigurationProfile $profile)
    {
        return $response;
    }
}
