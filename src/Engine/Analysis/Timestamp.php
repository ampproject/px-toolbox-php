<?php

namespace PageExperience\Engine\Analysis;

use DateTimeImmutable;
use DateTimeInterface;
use PageExperience\Engine\Exception\FailedToProcessTimestamp;

/**
 * Timestamp value object.
 *
 * This is used to not rely directly on the PHP DateTime(Immutable) implementation.
 *
 * @package ampproject/px-toolbox
 */
final class Timestamp
{
    /**
     * Internal timestamp storage.
     *
     * @var string
     */
    private $timestamp;

    /**
     * Instantiate a new Timestamp object.
     *
     * @param string $timestamp Timestamp to use.
     */
    private function __construct($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Instantiate a new Timestamp object for the current moment.
     *
     * @return self Timestamp object.
     */
    public static function now()
    {
        return self::fromDateTime(new DateTimeImmutable('now'));
    }


    /**
     * Instantiate a new Timestamp object from a DateTime object.
     *
     * @param DateTimeInterface $timestamp DateTime object to use as timestamp.
     * @return self Timestamp object.
     */
    public static function fromDateTime(DateTimeInterface $timestamp)
    {
        return new self($timestamp->format(DateTimeInterface::ATOM));
    }

    /**
     * Return timestamp as DateTimeImmutable object.
     *
     * @return DateTimeImmutable Timestamp as DateTimeImmutable object.
     * @throws FailedToProcessTimestamp If the timestamp could not be converted into a DateTimeImmutable.
     */
    public function asDateTimeImmutable()
    {
        $dateTime = DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $this->timestamp);

        if (! $dateTime instanceof DateTimeImmutable) {
            throw FailedToProcessTimestamp::forDateTimeImmutableFailure($dateTime, $this->timestamp);
        }

        return $dateTime;
    }

    /**
     * Render timestamp as a string.
     *
     * @return string Timestamp as a string.
     */
    public function __toString()
    {
        return $this->timestamp;
    }
}
