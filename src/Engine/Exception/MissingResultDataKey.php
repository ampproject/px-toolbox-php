<?php

namespace PageExperience\Engine\Exception;

use OutOfRangeException;

/**
 * Exception thrown when an invalid tool is being requested.
 *
 * @package ampproject/px-toolbox
 */
final class MissingResultDataKey extends OutOfRangeException implements PxEngineException
{
    /**
     * Instantiate a MissingResultDataKey exception for a key that is missing from the result data array.
     *
     * @param string $id  ID of the result data set.
     * @param string $key Key that is missing.
     * @return self
     */
    public static function forKey($id, $key)
    {
        $message = "Expected key '{$key}' is missing from provided result data set with ID '{$id}'.";

        return new self($message);
    }
}
