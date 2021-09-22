<?php

namespace PageExperience\Tool\AmpValidator;

use AmpProject\Exception\FailedToConfigureTool;
use AmpProject\Exception\ToolRulesetMismatch;
use Exception;
use PageExperience\Analysis\ToolRuleset;
use PageExperience\Tool\AmpValidator;
use PageExperience\Tool;

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
     * @param Tool $tool Tool to configure with this ruleset.
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
