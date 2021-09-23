<?php

namespace PageExperience\ToolStack;

use PageExperience\ConfigurationProfile;
use PageExperience\ToolStack;

/**
 * Factory for assembling a tool stack.
 *
 * @package ampproject/px-toolbox
 */
interface ToolStackFactory
{

    /**
     * Create a tool stack instance for analysis.
     *
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForAnalysis(ConfigurationProfile $profile);

    /**
     * Create a tool stack instance for optimization.
     *
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForOptimization(ConfigurationProfile $profile);
}
