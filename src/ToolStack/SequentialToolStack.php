<?php

namespace PageExperience\ToolStack;

use PageExperience\Analysis;
use PageExperience\ConfigurationProfile;
use PageExperience\Context;
use PageExperience\Tool;
use PageExperience\Tool\AnalysisTool;
use PageExperience\Tool\OptimizationTool;
use PageExperience\ToolStack;
use Psr\Http\Message\ResponseInterface;

/**
 * Stack of tools that execute synchronously in sequential order.
 *
 * @package ampproject/px-toolbox
 */
final class SequentialToolStack implements ToolStack
{

    /**
     * Array of tools to execute in sequential order.
     *
     * @var array<Tool>
     */
    private $tools;

    /**
     * Instantiate a SequentialToolStack object.
     *
     * @param Tool ...$tools Tools to execute in sequential order.
     */
    public function __construct(Tool ...$tools)
    {
        $this->tools = $tools;
    }

    /**
     * Analyze a URL.
     *
     * @param Analysis                $analysis Current state of the analysis.
     * @param string                  $url      URL to run an analysis for.
     * @param ConfigurationProfile    $profile  Configuration profile to use for the analysis.
     * @param \PageExperience\Context $context  Current context of the analysis.
     * @return Analysis Adapted page experience analysis.
     */
    public function analyze(Analysis $analysis, $url, ConfigurationProfile $profile, Context $context)
    {
        foreach ($this->tools as $tool) {
            if (! $tool instanceof AnalysisTool) {
                continue;
            }

            $tool->analyze($analysis, $url, $profile, $context);
        }

        return $analysis;
    }

    /**
     * Optimize a string of HTML.
     *
     * @param Analysis                $analysis Current state of the analysis.
     * @param string                  $html     String of HTML to run an analysis for.
     * @param ConfigurationProfile    $profile  Configuration profile to use for the analysis.
     * @param \PageExperience\Context $context  Current context of the analysis.
     * @return string String of optimized HTML.
     */
    public function optimizeHtml(Analysis $analysis, $html, ConfigurationProfile $profile, Context $context)
    {
        foreach ($this->tools as $tool) {
            if (! $tool instanceof OptimizationTool) {
                continue;
            }

            $html = $tool->optimizeHtml($analysis, $html, $profile, $context);
        }

        return $html;
    }

    /**
     * Optimize an HTTP response.
     *
     * @param Analysis                $analysis Current state of the analysis.
     * @param ResponseInterface       $response HTTP response to optimize.
     * @param ConfigurationProfile    $profile  Configuration profile to use for the analysis.
     * @param \PageExperience\Context $context  Current context of the analysis.
     * @return ResponseInterface Optimized HTTP response.
     */
    public function optimizeResponse(Analysis $analysis, $response, ConfigurationProfile $profile, Context $context)
    {
        foreach ($this->tools as $tool) {
            if (! $tool instanceof OptimizationTool) {
                continue;
            }

            $response = $tool->optimizeHtml($analysis, $response, $profile, $context);
        }

        return $response;
    }
}
