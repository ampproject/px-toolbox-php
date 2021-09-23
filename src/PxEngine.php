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
     * Factory instance to use for assembling a tool stack.
     *
     * @var ToolStackFactory
     */
    private $toolStackFactory;

    /**
     * Instantiate the Page Experience engine.
     *
     * @param ToolStackFactory|null $toolStackFactory Optional. Tool stack factory instance to use.
     */
    public function __construct(ToolStackFactory $toolStackFactory = null)
    {
        $this->toolStackFactory = $toolStackFactory instanceof ToolStackFactory
            ? $toolStackFactory
            : new DefaultToolStackFactory();
    }

    /**
     * Analyze a URL.
     *
     * @param string               $url     URL to run an analysis for.
     * @param ConfigurationProfile $profile Configuration profile to use for the analysis.
     * @return Analysis Page experience analysis.
     */
    public function analyze($url, ConfigurationProfile $profile)
    {
        $pipeline = $this->assemblePipelineForAnalysis($profile);

        return $pipeline->analyze($url);
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
        $pipeline = $this->assemblePipelineForOptimization($profile);

        return $pipeline->optimizeHtml($html);
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
        $pipeline = $this->assemblePipelineForOptimization($profile);

        return $pipeline->optimizeResponse($response);
    }

    /**
     * Assemble a page experience pipeline for analysis.
     *
     * @param ConfigurationProfile $profile Configuration profile to use for the analysis.
     * @return PxPipeline Analysis pipeline.
     */
    private function assemblePipelineForAnalysis(ConfigurationProfile $profile)
    {
        return new PxPipeline();
    }

    /**
     * Assemble a page experience pipeline for optimization.
     *
     * @param ConfigurationProfile $profile Configuration profile to use for the optimization.
     * @return PxPipeline Analysis pipeline.
     */
    private function assemblePipelineForOptimization(ConfigurationProfile $profile)
    {
        return new PxPipeline();
    }
}
