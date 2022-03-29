<?php

namespace PageExperience\Engine\Tool\Exception;

use InvalidArgumentException;

/**
 * Exception thrown when an unknown configuration key was requested.
 *
 * @package ampproject/px-toolbox
 */
final class UnknownConfigurationKey extends InvalidArgumentException implements PXEngineToolException
{
    /**
     * Instantiate an UnknownConfigurationKey exception for an unknown key.
     *
     * @param string $key Key that was unknown.
     * @return self
     */
    public static function fromKey($key)
    {
        $message = "The configuration does not contain the requested key '{$key}'.";

        return new self($message);
    }

    /**
     * Instantiate an UnknownConfigurationKey exception for an unknown tool configuration key.
     *
     * @param string $tool Tool class or identifier.
     * @param string $key  Key that was unknown.
     * @return self
     */
    public static function fromToolKey($tool, $key)
    {
        $parts   = explode('\\', $tool);
        $tool    = array_pop($parts);
        $message = "The configuration of the tool '{$tool}' does not contain "
                    . "the requested key '{$key}'.";

        return new self($message);
    }
}
