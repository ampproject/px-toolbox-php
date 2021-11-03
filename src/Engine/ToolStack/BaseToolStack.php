<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\Tool;
use PageExperience\Engine\Tool\ToolRuleset;
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
}
