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
     * List of tools and their dependencies.
     *
     * @var array<class-string<Tool>, array<class-string<Tool>>> Associative array of tools. Key is the tool FQCN,
     *                                                           value is an array of dependencies.
     */
    private $tools = [
        Tool\AmpOptimizer::class => [],
        Tool\AmpValidator::class => [],
        Tool\Lighthouse::class   => [],
    ];

    /**
     * Get the registered tools and their inter-dependencies.
     *
     * @return array<class-string<Tool>, array<class-string<Tool>>> Associative array of tools. Key is the tool FQCN,
     *                                                              value is an array of dependencies.
     */
    public function getTools()
    {
        // TODO: Use dynamic configuration data.

        // TODO: Dispatch event to allow for last-minute dynamic changes.

        return $this->tools;
    }

    /**
     * Register a new tool with the tool stack configuration.
     *
     * @param class-string<Tool>        $toolFqcn         Fully-qualified class name of the tool implementation.
     * @param array<class-string<Tool>> $toolDependencies Array of fully-qualified class names of the tool dependencies.
     */
    public function registerTool($toolFqcn, $toolDependencies)
    {
        $this->tools[$toolFqcn] = $toolDependencies;
    }
}
