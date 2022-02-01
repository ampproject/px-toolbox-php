<?php

namespace PageExperience\Engine\Exception;

use InvalidArgumentException;

/**
 * Exception thrown when an invalid renderer is being requested.
 *
 * @package ampproject/px-toolbox
 */
final class InvalidRenderer extends InvalidArgumentException implements PxEngineException
{
    /**
     * Instantiate an InvalidRenderer exception for a renderer that is not known.
     *
     * @param string $renderer Renderer that was requested.
     * @return self
     */
    public static function forRenderer($renderer)
    {
        $message = "Invalid renderer requested: '{$renderer}'.";

        return new self($message);
    }
}
