<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\Analysis\ToolRuleset;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;

/**
 * AMP Validator abstraction as a page experience tool.
 *
 * @package ampproject/px-toolbox
 */
final class AmpValidator implements AnalysisTool
{

    /**
     * Name of the tool.
     *
     * @var string
     */
    const NAME = 'amp-validator';

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
     * Analyze a URL.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param string               $url      URL to run an analysis for.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @return Analysis Adapted page experience analysis.
     */
    public function analyze(Analysis $analysis, $url, ConfigurationProfile $profile, Context $context)
    {
        // TODO: Implement analyze() method.

        return $analysis;
    }
}
