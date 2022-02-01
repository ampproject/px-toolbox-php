<?php

namespace PageExperience\Engine\Tool;

use AmpProject\Optimizer\DefaultConfiguration;
use AmpProject\Optimizer\ErrorCollection;
use AmpProject\Optimizer\TransformationEngine;
use AmpProject\RemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\StringStream;
use PageExperience\Engine\Tool\AmpOptimizer\Ruleset;
use Psr\Http\Message\ResponseInterface;

/**
 * AMP Optimizer abstraction as a page experience tool.
 *
 * @package ampproject/px-toolbox
 */
final class AmpOptimizer implements OptimizationTool, Configurable
{
    /**
     * Name of the tool.
     *
     * @var string
     */
    const NAME = 'amp-optimizer';

    /**
     * Remote request handler instance to use.
     *
     * @var RemoteGetRequest
     */
    private $remoteRequest;

    /**
     * Ruleset the tool is to be configured with.
     *
     * @var ToolRuleset
     */
    private $toolRuleset;

    /**
     * Instantiate a Lighthouse tool instance.
     *
     * @param RemoteGetRequest $remoteRequest Remote request handler instance to use.
     */
    public function __construct(RemoteGetRequest $remoteRequest)
    {
        $this->remoteRequest = $remoteRequest;
    }

    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * Get the FQCN of the tool's ruleset object.
     *
     * @return class-string<ToolRuleset> FQCN of the tool's ruleset object.
     */
    public function getRulesetFqcn()
    {
        return Ruleset::class;
    }

    /**
     * Configure the tool with a given ruleset.
     *
     * @param ToolRuleset $toolRuleset Ruleset to configure the tool with.
     * @return void
     */
    public function configureWithRuleset(ToolRuleset $toolRuleset)
    {
        $this->toolRuleset = $toolRuleset;
    }

    /**
     * Optimize a string of HTML.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param string               $html     String of HTML to run an analysis for.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @return string String of optimized HTML.
     */
    public function optimizeHtml(Analysis $analysis, $html, ConfigurationProfile $profile, Context $context)
    {
        $this->toolRuleset->configureTool($this);

        // TODO: Use the tool ruleset to adapt the configuration.
        $configuration = new DefaultConfiguration();

        $errorCollection = new ErrorCollection();

        $optimizer = new TransformationEngine($configuration, $this->remoteRequest);

        $optimizedHtml = $optimizer->optimizeHtml($html, $errorCollection);

        // TODO: Check error collection.

        return $optimizedHtml;
    }

    /**
     * Optimize an HTTP response.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param ResponseInterface    $response HTTP response to optimize.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @return ResponseInterface Optimized HTTP response.
     */
    public function optimizeResponse(
        Analysis $analysis,
        ResponseInterface $response,
        ConfigurationProfile $profile,
        Context $context
    ) {
        $optimizedHtml = $this->optimizeHtml($analysis, (string) $response->getBody(), $profile, $context);

        return $response->withBody(new StringStream($optimizedHtml));
    }
}
