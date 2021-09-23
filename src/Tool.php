<?php

namespace PageExperience;

use PageExperience\Analysis\ToolRuleset;

/**
 * Individual tool that powers the aggregated page experience analysis.
 *
 * @package ampproject/px-toolbox
 */
interface Tool
{

    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getName();


    /**
     * Configure the tool with a given ruleset.
     *
     * @param ToolRuleset $toolRuleset Ruleset to configure the tool with.
     * @return void
     */
    public function configureWithRuleset(ToolRuleset $toolRuleset);
}
