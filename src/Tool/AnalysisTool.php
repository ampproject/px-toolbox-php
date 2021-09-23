<?php

namespace PageExperience\Tool;

use PageExperience\Analysis;
use PageExperience\Analysis\Context;
use PageExperience\ConfigurationProfile;
use PageExperience\Tool;

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
     * @return Analysis Adapted page experience analysis.
     */
    public function analyze(Analysis $analysis, $url, ConfigurationProfile $profile, Context $context);
}
