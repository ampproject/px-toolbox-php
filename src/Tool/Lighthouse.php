<?php

namespace PageExperience\Tool;

use PageExperience\Analysis\ToolRuleset;
use PageExperience\Tool;

/**
 * Lighthouse abstraction as a page experience tool.
 *
 * @package ampproject/px-toolbox
 */
final class Lighthouse implements Tool
{

    /**
     * Name of the tool.
     *
     * @var string
     */
    const NAME = 'lighthouse';

    /**
     * Ruleset the tool is to be configured with.
     *
     * @var ToolRuleset
     */
    private $toolRuleset;

    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * Configure the tool with a given ruleset.
     *
     * @param ToolRuleset $toolRuleset Ruleset to configure the tool with.
     */
    public function configureWithRuleset(ToolRuleset $toolRuleset)
    {
        $this->toolRuleset = $toolRuleset;
    }
}
