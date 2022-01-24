<?php

namespace PageExperience\Engine\Tool\AmpOptimizer;

use Exception;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Exception\FailedToConfigureTool;
use PageExperience\Engine\Exception\ToolRulesetMismatch;
use PageExperience\Engine\Tool;
use PageExperience\Engine\Tool\AmpOptimizer;
use PageExperience\Engine\Tool\ToolRuleset;

/**
 * Ruleset for the AMP Optimizer tool.
 *
 * @package ampproject/px-toolbox
 */
final class Ruleset implements ToolRuleset
{
    /**
     * Instantiate a new ruleset from a configuration profile.
     *
     * @param ConfigurationProfile $profile Configuration profile to instantiate a ruleset from.
     * @return ToolRuleset Ruleset instance.
     */
    public static function fromProfile(ConfigurationProfile $profile)
    {
        // TODO: Instantiate out of real configuration data.

        return new self();
    }

    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getToolName()
    {
        return AmpOptimizer::NAME;
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
        if (! $tool instanceof AmpOptimizer) {
            throw ToolRulesetMismatch::forToolWithToolRuleset($tool, $this);
        }

        try {
            $tool->configureWithRuleset($this);
        } catch (Exception $exception) {
            throw FailedToConfigureTool::forTool($tool->getName(), $exception);
        }
    }
}
