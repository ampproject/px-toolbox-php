<?php

namespace PageExperience\Engine;

use Psr\Http\Message\ResponseInterface;

/**
 * Page experience engine pipeline.
 *
 * @package ampproject/px-toolbox
 */
final class Pipeline
{

    /**
     * Tool stack to use for the pipeline.
     *
     * @var ToolStack
     */
    private $toolStack;

    /**
     * Configuration profile to use for the pipeline.
     *
     * @var ConfigurationProfile
     */
    private $profile;

    /**
     * Instantiate a Pipeline object.
     *
     * @param ToolStack            $toolStack Tool stack to use for the pipeline.
     * @param ConfigurationProfile $profile   Configuration profile to use for the pipeline.
     */
    public function __construct(ToolStack $toolStack, ConfigurationProfile $profile)
    {
        $this->toolStack = $toolStack;
        $this->profile   = $profile;
    }

    /**
     * Analyze a URL.
     *
     * @param string $url URL to run an analysis for.
     * @return Analysis Page experience analysis.
     */
    public function analyze($url)
    {
        // TODO: Implement analysis logic.

        $analysis = new Analysis\PageExperienceAnalysis(
            Analysis\Status::UNKNOWN(),
            Analysis\Timestamp::now(),
            Analysis\Scope::PAGE(),
            new Analysis\Ruleset('L1')
        );

        $context = new Context();

        return $this->toolStack->analyze($analysis, $url, $this->profile, $context);
    }

    /**
     * Optimize a string of HTML.
     *
     * @param string $html String of HTML to optimize.
     * @return string String of optimized HTML.
     */
    public function optimizeHtml($html)
    {
        // TODO: Implement optimization logic.

        return $html;
    }

    /**
     * Optimize an HTTP response.
     *
     * @param ResponseInterface $response HTTP response to optimize.
     * @return ResponseInterface Optimized HTTP response.
     */
    public function optimizeResponse(ResponseInterface $response)
    {
        // TODO: Implement optimization logic.

        return $response;
    }
}
