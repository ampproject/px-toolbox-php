<?php

namespace AmpProject\Exception;

use PageExperience\Exception\PxEngineException;
use Exception;
use RuntimeException;

/**
 * Exception thrown when a tool could not be configured.
 *
 * @package ampproject/px-toolbox
 */
final class FailedToConfigureTool extends RuntimeException implements PxEngineException
{

    /**
     * Instantiate a FailedToConfigureTool exception for a tool that could not be configured.
     *
     * @param string         $tool     Name of the tool for which configuration failed.
     * @param Exception|null $previous Optional. Previous exception that was thrown. Defaults to null.
     * @return self
     */
    public static function forTool($tool, Exception $previous = null)
    {
        $message = "Failed to configure page experience tool '{$tool}'.";

        if ($previous instanceof Exception) {
            $message .= " Reason: {$previous->getMessage()}";
        }

        return new self($message, 0, $previous);
    }
}
