<?php

namespace PageExperience\Engine;

/**
 * Individual tool that powers the aggregated page experience analysis.
 *
 * @package ampproject/px-toolbox
 */
interface Tool
{
    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getName();
}
