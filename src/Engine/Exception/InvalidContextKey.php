<?php

namespace PageExperience\Engine\Exception;

use InvalidArgumentException;

/**
 * Exception thrown when an invalid context key is being requested.
 *
 * @package ampproject/px-toolbox
 */
final class InvalidContextKey extends InvalidArgumentException implements PxEngineException
{
    /**
     * Instantiate an InvalidContextKey exception for a context key that is not known.
     *
     * @param string $contextKey Context key that was requested.
     * @return self
     */
    public static function forContextKey($contextKey)
    {
        $message = "Invalid context key requested: '{$contextKey}'.";

        return new self($message);
    }
}
