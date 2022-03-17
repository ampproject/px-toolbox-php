<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Dsl\Operation\RuleCollection;

/**
 * A tool that is programmable.
 *
 * @package ampproject/px-toolbox
 */
interface Programmable
{
    /**
     * Attach a rule collection to the tool.
     *
     * @param RuleCollection $ruleCollection Rule collection to attach.
     * @return void
     */
    public function attachRuleCollection(RuleCollection $ruleCollection);
}
