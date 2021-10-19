<?php

namespace AmpProject\Exception;

use PageExperience\Engine\Analysis\ToolRuleset;
use PageExperience\Engine\Tool;
use PageExperience\Engine\Exception\PxEngineException;
use RuntimeException;

/**
 * Exception thrown when there was a mismatch between a tool and the ruleset it should be configured with.
 *
 * @package ampproject/px-toolbox
 */
final class ToolRulesetMismatch extends RuntimeException implements PxEngineException
{

    /**
     * Instantiate a ToolRulesetMismatch exception for a tool that did not match the provided ruleset.
     *
     * @param Tool        $tool        Tool that did not match the ruleset.
     * @param ToolRuleset $toolRuleset Ruleset that did not match the tool.
     * @return self
     */
    public static function forToolWithToolRuleset(Tool $tool, ToolRuleset $toolRuleset)
    {
        $toolName        = $tool->getName();
        $rulesetToolName = $toolRuleset->getToolName();

        $message = "Could not configure tool '{$toolName}' with ruleset targeted at tool '{$rulesetToolName}'.";

        return new self($message);
    }
}
