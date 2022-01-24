<?php

namespace PageExperience\Engine\Exception;

use PageExperience\Engine\Tool;
use PageExperience\Engine\Tool\ToolRuleset;
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

    /**
     * Instantiate a ToolRulesetMismatch exception for a ruleset that does not implement the right base class.
     *
     * @param Tool                      $tool          Tool that could not be configured.
     * @param ToolRuleset               $toolRuleset   Ruleset that did not match the tool.
     * @param class-string<ToolRuleset> $expectedClass Expected FQCN for the matching ruleset.
     * @return self
     */
    public static function forToolRulesetClassMismatch(Tool $tool, ToolRuleset $toolRuleset, $expectedClass)
    {
        $toolName    = $tool->getName();
        $actualClass = get_class($toolRuleset);

        $message = "Could not configure tool '{$toolName}' with ruleset of wrong type.";
        $message .= " Expected object of type '{$expectedClass}', but got '{$actualClass}'.";

        return new self($message);
    }
}
