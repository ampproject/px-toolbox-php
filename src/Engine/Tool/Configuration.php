<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Tool\Exception\UnknownConfigurationKey;

/**
 * Interface for a PX tool configuration object that validates and stores configuration settings.
 *
 * @package ampproject/px-toolbox
 */
interface Configuration
{
    /**
     * Key to use for managing the array of active tools.
     *
     * @var string
     */
    const KEY_TOOLS = 'tools';

    /**
     * Array of known configuration keys and their default values.
     *
     * @var array{tools: string[]}
     */
    const DEFAULTS = [
        self::KEY_TOOLS => self::DEFAULT_TOOLS,
    ];

    /**
     * Array of FQCNs of tools to use for the default setup.
     *
     * @var string[]
     */
    const DEFAULT_TOOLS = [
        Tool\AmpOptimizer::class,
        Tool\AmpValidator::class,
        Tool\PageSpeedInsights::class,
    ];

    /**
     * Register a new configuration class to use for a given tool.
     *
     * @param string $toolClass   FQCN of the tool to register a configuration class for.
     * @param string $configurationClass FQCN of the configuration to use.
     */
    public function registerConfigurationClass($toolClass, $configurationClass);

    /**
     * Check whether the configuration has a given setting.
     *
     * @param string $key Configuration key to look for.
     * @return bool Whether the requested configuration key was found or not.
     */
    public function has($key);

    /**
     * Get the value for a given key from the configuration.
     *
     * @param string $key Configuration key to get the value for.
     * @return mixed Configuration value for the requested key.
     * @throws UnknownConfigurationKey If the key was not found.
     */
    public function get($key);

    /**
     * Get the tool-specific configuration for the requested tool.
     *
     * @param string $toolClassName FQCN of the tool to get the configuration for.
     * @return ToolConfiguration tool-specific configuration.
     */
    public function getToolConfiguration($toolClassName);
}
