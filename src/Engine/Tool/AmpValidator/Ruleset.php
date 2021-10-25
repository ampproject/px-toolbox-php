<?php

namespace PageExperience\Engine\Tool\AmpValidator;

use Exception;
use PageExperience\Engine\Exception\FailedToConfigureTool;
use PageExperience\Engine\Exception\ToolRulesetMismatch;
use PageExperience\Engine\Tool;
use PageExperience\Engine\Tool\AmpValidator;
use PageExperience\Engine\Tool\ToolRuleset;

/**
 * Ruleset for the AMP Validator tool.
 *
 * @package ampproject/px-toolbox
 */
final class Ruleset implements ToolRuleset
{


    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getToolName()
    {
        return AmpValidator::NAME;
    }

    /**
     * Configure the tool based on this ruleset.
     *
     * @param \PageExperience\Engine\Tool $tool Tool to configure with this ruleset.
     * @return void
     *
     * @throws ToolRulesetMismatch   If the ruleset did not match the provided tool.
     * @throws FailedToConfigureTool If the configuration of the tool failed.
     */
    public function configureTool(Tool $tool)
    {
        if (! $tool instanceof AmpValidator) {
            throw ToolRulesetMismatch::forToolWithToolRuleset($tool, $this);
        }

        try {
            $tool->configureWithRuleset($this);
        } catch (Exception $exception) {
            throw FailedToConfigureTool::forTool($tool->getName(), $exception);
        }
    }
}
