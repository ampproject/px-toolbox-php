<?php

namespace PageExperience\Engine\Dsl;

/**
 * Parser for turning a DSL JSON file into an object hierarchy of operations.
 *
 * @package ampproject/px-toolbox
 */
interface ToolSpecific
{
    /**
     * Get the name of the tool that this is for.
     *
     * @return string Name of the tool that this is for.
     */
    public function getToolName();
}
