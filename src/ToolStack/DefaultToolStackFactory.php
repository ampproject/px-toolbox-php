<?php

namespace PageExperience\ToolStack;

use PageExperience\ConfigurationProfile;
use PageExperience\ToolStack;

/**
 * Factory for assembling a tool stack.
 *
 * @package ampproject/px-toolbox
 */
final class DefaultToolStackFactory implements ToolStackFactory
{

    /**
     * Create a tool stack instance for analysis.
     *
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForAnalysis(ConfigurationProfile $profile)
    {
        // TODO: Implement createForAnalysis() method.
    }

    /**
     * Create a tool stack instance for optimization.
     *
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForOptimization(ConfigurationProfile $profile)
    {
        // TODO: Implement createForOptimization() method.
    }
}
