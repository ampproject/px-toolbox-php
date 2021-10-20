<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\Analysis\ToolRuleset;
use PageExperience\Engine\Tool;
use PageExperience\Engine\ToolStack;

/**
 * Stack of tools that execute asynchronously and in parallel.
 *
 * @package ampproject/px-toolbox
 */
abstract class BaseToolStack implements ToolStack
{

    /**
     * Array of tools to execute in sequential order.
     *
     * @var array<Tool>
     */
    protected $tools;

    /**
     * Instantiate a SequentialToolStack object.
     *
     * @param Tool ...$tools Tools to execute in sequential order.
     */
    public function __construct(Tool ...$tools)
    {
        $this->tools = $tools;
    }

    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getName()
    {
        return '[toolstack]';
    }

    /**
     * Configure the tool with a given ruleset.
     *
     * @param ToolRuleset $toolRuleset Ruleset to configure the tool with.
     * @return void
     */
    public function configureWithRuleset(ToolRuleset $toolRuleset)
    {
        foreach ($this->tools as $tool) {
            $tool->configureWithRuleset($toolRuleset);
        }
    }
}
