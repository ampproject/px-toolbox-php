<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Rules;
use PageExperience\Engine\ToolStack;

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
     * @param Rules                $rules   Rules to use for the programmable tools.
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForAnalysis(Rules $rules, ConfigurationProfile $profile);

    /**
     * Create a tool stack instance for optimization.
     *
     * @param Rules                $rules   Rules to use for the programmable tools.
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForOptimization(Rules $rules, ConfigurationProfile $profile);
}
