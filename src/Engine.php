<?php

namespace PageExperience;

use PageExperience\Engine\ToolStack\DefaultToolStackFactory;
use PageExperience\Engine\ToolStack\ToolStackConfiguration;
use PageExperience\Engine\ToolStack\ToolStackFactory;
use Psr\Http\Message\ResponseInterface;

/**
 * Page experience engine.
 *
 * @package ampproject/px-toolbox
 */
final class Engine
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
            : new DefaultToolStackFactory(new ToolStackConfiguration());
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
     * @return Pipeline Analysis pipeline.
     */
    private function assemblePipelineForAnalysis(ConfigurationProfile $profile)
    {
        $toolStack = $this->toolStackFactory->createForAnalysis($profile);

        return new Pipeline($toolStack);
    }

    /**
     * Assemble a page experience pipeline for optimization.
     *
     * @param ConfigurationProfile $profile Configuration profile to use for the optimization.
     * @return Pipeline Analysis pipeline.
     */
    private function assemblePipelineForOptimization(ConfigurationProfile $profile)
    {
        $toolStack = $this->toolStackFactory->createForOptimization($profile);

        return new Pipeline($toolstack);
    }
}
