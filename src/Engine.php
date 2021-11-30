<?php

namespace PageExperience;

use AmpProject\RemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\Analysis\PageExperienceAnalysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
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
     * @param RemoteGetRequest|null $remoteRequest    Optional. Remote request handler instance to use.
     * @param ToolStackFactory|null $toolStackFactory Optional. Tool stack factory instance to use.
     */
    public function __construct(RemoteGetRequest $remoteRequest = null, ToolStackFactory $toolStackFactory = null)
    {
        $this->toolStackFactory = $toolStackFactory instanceof ToolStackFactory
            ? $toolStackFactory
            : new DefaultToolStackFactory(
                ToolStackConfiguration::fromJsonFile(__DIR__ . '/../default-toolstack.json'),
                $remoteRequest
            );
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
        $toolStack = $this->toolStackFactory->createForAnalysis($profile);

        return $toolStack->analyze(new PageExperienceAnalysis(), $url, $profile, new Context());
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
        $toolStack = $this->toolStackFactory->createForOptimization($profile);

        return $toolStack->optimizeHtml(new PageExperienceAnalysis(), $html, $profile, new Context());
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
        $toolStack = $this->toolStackFactory->createForOptimization($profile);

        return $toolStack->optimizeResponse(new PageExperienceAnalysis(), $response, $profile, new Context());
    }
}
