<?php

namespace AmpProject\Exception;

use PageExperience\Analysis\ToolRuleset;
use PageExperience\Exception\PxEngineException;
use PageExperience\Tool;
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
        $rulesetToolName = $toolRuleset->getName();

        $message = "Could not configure tool '{$toolName}' with ruleset targeted at tool '{$rulesetToolName}'.";

        return new self($message);
    }
}
