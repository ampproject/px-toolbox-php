<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\Analysis\ToolRuleset;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use Psr\Http\Message\ResponseInterface;

/**
 * AMP Optimizer abstraction as a page experience tool.
 *
 * @package ampproject/px-toolbox
 */
final class AmpOptimizer implements OptimizationTool
{

    /**
     * Name of the tool.
     *
     * @var string
     */
    const NAME = 'amp-optimizer';

    /**
     * Ruleset the tool is to be configured with.
     *
     * @var ToolRuleset
     */
    private $toolRuleset;

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
        // TODO: Implement optimizeHtml() method.

        return $html;
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
    public function optimizeResponse(Analysis $analysis, $response, ConfigurationProfile $profile, Context $context)
    {
        // TODO: Implement optimizeResponse() method.

        return $response;
    }
}
