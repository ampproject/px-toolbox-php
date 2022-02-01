<?php

namespace PageExperience\Engine\Exception;

use RuntimeException;

/**
 * Exception thrown when a tool could not be configured.
 *
 * @package ampproject/px-toolbox
 */
final class FailedToProcessTimestamp extends RuntimeException implements PxEngineException
{
    /**
     * Instantiate a FailedToProcessTimestamp exception for an instantiation of DateTimeImmutable that failed.
     *
     * @param mixed $dateTime  Value of the result of a DateTimeImmutable instantiation.
     * @param mixed $timestamp Timestamp for which the DateTimeImmutable object was meant to be instantiated.
     * @return self
     */
    public static function forDateTimeImmutableFailure($dateTime, $timestamp)
    {
        $message = sprintf(
            "Failed to instantiate a DateTimeImmutable object for timestamp '%s', got '%s' instead.",
            new ValueDump($timestamp),
            new ValueDump($dateTime)
        );

        return new self($message);
    }
}
