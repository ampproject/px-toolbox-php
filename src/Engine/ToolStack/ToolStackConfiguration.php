<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\Tool;

/**
 * Configuration for assembling a tool stack.
 *
 * @package ampproject/px-toolbox
 */
final class ToolStackConfiguration
{

    /**
     * Get the registered tools and their inter-dependencies.
     *
     * @return array<array<string>> Associative array of tools. Key is the tool name, value is an array of dependencies.
     */
    public function getTools()
    {
        // TODO: Use dynamic configuration data.

        return [
            Tool\AmpOptimizer::NAME => [],
            Tool\AmpValidator::NAME => [],
            Tool\Lighthouse::NAME   => [],
        ];
    }
}
