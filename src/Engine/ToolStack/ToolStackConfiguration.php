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
     * @return array<class-string<Tool>, array<class-string<Tool>>> Associative array of tools. Key is the tool name,
     *                                                              value is an array of dependencies.
     */
    public function getTools()
    {
        // TODO: Use dynamic configuration data.

        return [
            Tool\AmpOptimizer::class => [],
            Tool\AmpValidator::class => [],
            Tool\Lighthouse::class   => [],
        ];
    }
}
