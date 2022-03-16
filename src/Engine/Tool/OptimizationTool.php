<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Tool that provides optimization capabilities.
 *
 * @package ampproject/px-toolbox
 */
interface OptimizationTool extends Tool
{
    /**
     * Optimize a string of HTML.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param string               $html     String of HTML to run an analysis for.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @param LoggerInterface      $logger   Logs that are collected during optimization.
     * @return string String of optimized HTML.
     */
    public function optimizeHtml(
        Analysis $analysis,
        $html,
        ConfigurationProfile $profile,
        Context $context,
        LoggerInterface $logger
    );

    /**
     * Optimize an HTTP response.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param ResponseInterface    $response HTTP response to optimize.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @param LoggerInterface      $logger   Logs that are collected during optimization.
     * @return ResponseInterface Optimized HTTP response.
     */
    public function optimizeResponse(
        Analysis $analysis,
        ResponseInterface $response,
        ConfigurationProfile $profile,
        Context $context,
        LoggerInterface $logger
    );
}
