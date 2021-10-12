<?php

namespace PageExperience;

use Psr\Http\Message\ResponseInterface;

/**
 * Page experience engine pipeline.
 *
 * @package ampproject/px-toolbox
 */
final class PxPipeline
{

    /**
     * Tool stack to use for the pipeline.
     *
     * @var ToolStack
     */
    private $toolStack;

    /**
     * Instantiate a PxPipeline object.
     *
     * @param ToolStack $toolStack Tool stack to use for the pipeline.
     */
    public function __construct(ToolStack $toolStack)
    {
        $this->toolStack = $toolStack;
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

        return new Analysis\PageExperienceAnalysis(
            Analysis\Status::SUCCESS(),
            Analysis\Timestamp::now(),
            Analysis\Scope::PAGE(),
            new Analysis\Ruleset('L1')
        );
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
