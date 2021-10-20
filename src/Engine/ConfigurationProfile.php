<?php

namespace PageExperience\Engine;

/**
 * Page experience engine configuration profile.
 *
 * @package ampproject/px-toolbox
 */
class ConfigurationProfile
{

    /**
     * Check whether a given tool is being used by the configuration profile.
     *
     * @param string $toolName Name of the tool to check for.
     * @return bool Whether the given tool is being used by the configuration profile.
     */
    public function usesTool($toolName)
    {
        // TODO: Add logic to detect presence of tool by name.

        return true;
    }
}
