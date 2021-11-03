<?php

namespace PageExperience\Engine\Tool;

/**
 * Individual tool that powers the aggregated page experience analysis.
 *
 * @package ampproject/px-toolbox
 */
interface Configurable
{

    /**
     * Get the FQCN of the tool's ruleset object.
     *
     * @return class-string<ToolRuleset> FQCN of the tool's ruleset object.
     */
    public function getRulesetFqcn();

    /**
     * Configure the tool with a given ruleset.
     *
     * @param ToolRuleset $toolRuleset Ruleset to configure the tool with.
     * @return void
     */
    public function configureWithRuleset(ToolRuleset $toolRuleset);
}
