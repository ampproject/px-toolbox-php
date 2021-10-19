<?php

namespace PageExperience\Engine\Analysis;

/**
 * Ruleset of the analysis.
 *
 * @package ampproject/px-toolbox
 */
final class Ruleset
{

    /**
     * Name of the ruleset.
     *
     * @var string
     */
    private $name;

    /**
     * Individual rulesets for each of the involved tools.
     *
     * @var array<ToolRuleset>
     */
    private $toolRulesets = [];

    /**
     * Instantiate a Ruleset object.
     *
     * @param string             $name         Name of the ruleset.
     * @param array<ToolRuleset> $toolRulesets Individual rulesets for each of the involved tools.
     */
    public function __construct($name, $toolRulesets = [])
    {
        $this->name = $name;
        array_map([$this, 'addToolRuleset'], $toolRulesets);
    }

    /**
     * Add an individual tool ruleset.
     *
     * @param ToolRuleset $toolRuleset Individual tool ruleset to add.
     */
    public function addToolRuleset(ToolRuleset $toolRuleset)
    {
        $this->toolRulesets[] = $toolRuleset;
    }

    /**
     * Get the name of the ruleset.
     *
     * @return string Name of the ruleset.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the individual rulesets for each of the involved tools.
     *
     * @return array<ToolRuleset> Individual rulesets for each of the involved tools.
     */
    public function getToolRulesets()
    {
        return $this->toolRulesets;
    }
}
