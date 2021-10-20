<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Tool;
use PageExperience\Engine\Tool\AnalysisTool;
use PageExperience\Engine\Tool\OptimizationTool;
use PageExperience\Engine\ToolStack;

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
        return $this->assembleToolStack(AnalysisTool::class, $profile);
    }

    /**
     * Create a tool stack instance for optimization.
     *
     * @param ConfigurationProfile $profile Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    public function createForOptimization(ConfigurationProfile $profile)
    {
        return $this->assembleToolStack(OptimizationTool::class, $profile);
    }

    /**
     * Assemble a tool stack for a given type of tool.
     *
     * @param class-string<Tool>   $toolType Type of tool to assemble the tool stack for.
     * @param ConfigurationProfile $profile  Configuration profile to use.
     * @return ToolStack Assembled tool stack.
     */
    private function assembleToolStack($toolType, ConfigurationProfile $profile)
    {
        $toolClassNames = $this->toolStackConfiguration->getTools();

        $tools = [];
        foreach ($toolClassNames as $toolClassName => $dependencies) {
            if (is_a($toolClassName, $toolType, true)) {
                $tool = new $toolClassName();

                if (! $profile->usesTool($tool->getName())) {
                    continue;
                }

                $tools[$tool->getName()] = [$tool, $dependencies];
            }
        }

        // TODO: Parallelize as much as possible.

        return new SequentialToolStack(...array_column($tools, 0));
    }
}
