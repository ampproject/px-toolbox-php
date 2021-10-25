<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Exception\FailedToConfigureTool;
use PageExperience\Engine\Exception\ToolRulesetMismatch;
use PageExperience\Engine\Tool;

/**
 * Ruleset for an individual tool powering an analysis.
 *
 * @package ampproject/px-toolbox
 */
interface ToolRuleset
{

    /**
     * Get the name of the tool ruleset.
     *
     * @return string Name of the tool ruleset.
     */
    public function getToolName();

    /**
     * Configure the tool based on this ruleset.
     *
     * @param Tool $tool Tool to configure with this ruleset.
     * @return void
     *
     * @throws ToolRulesetMismatch   If the ruleset did not match the provided tool.
     * @throws FailedToConfigureTool If the configuration of the tool failed.
     */
    public function configureTool(Tool $tool);
}
