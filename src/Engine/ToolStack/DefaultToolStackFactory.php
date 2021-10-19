<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\ToolStack;
use PageExperience\Engine\Tool\AnalysisTool;

/**
 * Factory for assembling a tool stack.
 *
 * @package ampproject/px-toolbox
 */
final class DefaultToolStackFactory implements ToolStackFactory
{

    /**
     * Tool stack configuration to use.
     *
     * @var ToolStackConfiguration
     */
    private $toolStackConfiguration;

    /**
     * Instantiate a default tool stack factory object.
     *
     * @param ToolStackConfiguration $toolStackConfiguration Tool stack configuration to use.
     */
    public function __construct(ToolStackConfiguration $toolStackConfiguration)
    {
        $this->toolStackConfiguration = $toolStackConfiguration;
    }

    /**
     * Create a tool stack instance for analysis.
     *
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForAnalysis(ConfigurationProfile $profile)
    {
        $toolClassNames = $this->toolStackConfiguration->getTools();

        foreach ($toolClassNames as $toolClassName => $dependencies) {
            if (is_a($toolClassName, AnalysisTool::class, true)) {
                $tools[$toolClassName] = new $toolClassName();
            }
        }


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
