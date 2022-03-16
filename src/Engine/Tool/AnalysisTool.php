<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool;
use Psr\Log\LoggerInterface;

/**
 * Tool that provides optimization capabilities.
 *
 * @package ampproject/px-toolbox
 */
interface AnalysisTool extends Tool
{
    /**
     * Analyze a URL.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param string               $url      URL to run an analysis for.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @param LoggerInterface      $logger   Logs that are collected during analysis.
     * @return Analysis Adapted page experience analysis.
     */
    public function analyze(
        Analysis $analysis,
        $url,
        ConfigurationProfile $profile,
        Context $context,
        LoggerInterface $logger
    );
}
