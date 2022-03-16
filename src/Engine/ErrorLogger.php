<?php

namespace PageExperience\Engine;

use Countable;
use ArrayIterator;
use IteratorAggregate;
use PageExperience\Engine\Exception\InvalidArgumentException;

/**
 * Error logger object.
 *
 * @package ampproject/px-toolbox
 */
class ErrorLogger implements Logger, Countable, IteratorAggregate
{
    /**
     * System is unusable.
     *
     * @var string
     */
    const EMERGENCY = 'emergency';

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @var string
     */
    const ALERT = 'alert';

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @var string
     */
    const CRITICAL = 'critical';

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @var string
     */
    const ERROR = 'error';

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @var string
     */
    const WARNING = 'warning';

    /**
     * Normal but significant events.
     *
     * @var string
     */
    const NOTICE = 'notice';

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @var string
     */
    const INFO = 'info';

    /**
     * Detailed debug information.
     *
     * @var string
     */
    const DEBUG = 'debug';

    /**
     * Logging levels from syslog protocol defined in RFC 5424
     *
     * @var array
     */
    protected static $levels = [
        self::DEBUG     => 'DEBUG',
        self::INFO      => 'INFO',
        self::NOTICE    => 'NOTICE',
        self::WARNING   => 'WARNING',
        self::ERROR     => 'ERROR',
        self::CRITICAL  => 'CRITICAL',
        self::ALERT     => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    ];

    /**
     * List of recorded error logs.
     *
     * @var array
     */
    private $logs = [];

    /**
     * System is unusable.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function emergency($message, $context = [])
    {
        $this->log(self::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function alert($message, $context = [])
    {
        $this->log(self::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function critical($message, $context = [])
    {
        $this->log(self::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function error($message, $context = [])
    {
        $this->log(self::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function warning($message, $context = [])
    {
        $this->log(self::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function notice($message, $context = [])
    {
        $this->log(self::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function info($message, $context = [])
    {
        $this->log(self::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function debug($message, $context = [])
    {
        $this->log(self::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level   The log level.
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     *
     * @throws InvalidArgumentException If the log level is invalid.
     */
    public function log($level, $message, $context = [])
    {
        if (! isset(self::$levels[$level])) {
            throw new InvalidArgumentException(
                'Level "' . $level . '" is not defined, use one of: ' . implode(', ', array_keys(self::$levels))
            );
        }

        $this->logs[] = [
            'level'    => self::$levels[$level],
            'message'  => (string) $message,
            'context'  => $context,
        ];
    }

   /**
     * Get the iterator for iterating over the logs.
     *
     * @return ArrayIterator Iterator for the contained logs.
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        return new ArrayIterator($this->logs);
    }

    /**
     * Count how many logs are contained within the error logs.
     *
     * @return int Number of contained logs.
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return count($this->logs);
    }
}
