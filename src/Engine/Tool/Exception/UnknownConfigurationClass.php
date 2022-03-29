<?php

namespace PageExperience\Engine\Tool\Exception;

use InvalidArgumentException;

/**
 * Exception thrown when an unknown configuration key was requested.
 *
 * @package ampproject/px-toolbox
 */
final class UnknownConfigurationClass extends InvalidArgumentException implements PXEngineToolException
{
    /**
     * Instantiate an UnknownConfigurationClass exception for an unknown configuration class.
     *
     * @param string $toolClass Key that was unknown.
     * @return self
     */
    public static function forToolClass($toolClass)
    {
        $message = "No configuration class was registered for the tool '{$toolClass}'.";

        return new self($message);
    }
}
