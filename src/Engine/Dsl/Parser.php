<?php

namespace PageExperience\Engine\Dsl;

/**
 * Parser for turning a DSL JSON file into an object hierarchy of operations.
 *
 * @package ampproject/px-toolbox
 */
interface Parser
{
    /**
     * Parse the DSL(s) into an object hierarchy.
     *
     * @return array<Expression>
     */
    public function parse();
}
