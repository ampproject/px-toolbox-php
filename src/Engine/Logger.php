<?php

namespace PageExperience\Engine;

/**
 * Describes a logger instance.
 *
 * The message MUST be a string or object implementing __toString().
 *
 * The message MAY contain placeholders in the form: {foo} where foo
 * will be replaced by the context data in key "foo".
 *
 * The context array can contain arbitrary data. The only assumption that
 * can be made by implementors is that if an Exception instance is given
 * to produce a stack trace, it MUST be in a key named "exception".
 *
 * See https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
 * for the full interface specification.
 *
 * @package ampproject/px-toolbox
 */
interface Logger
{
    /**
     * System is unusable.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function emergency($message, $context = []);

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
    public function alert($message, $context = []);

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
    public function critical($message, $context = []);

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function error($message, $context = []);

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
    public function warning($message, $context = []);

    /**
     * Normal but significant events.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function notice($message, $context = []);

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
    public function info($message, $context = []);

    /**
     * Detailed debug information.
     *
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     */
    public function debug($message, $context = []);

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level   The log level.
     * @param string  $message The log message.
     * @param mixed[] $context The log context.
     *
     * @return void
     *
     * @throws \PageExperience\Engine\Exception\InvalidArgumentException If the log level is invalid.
     */
    public function log($level, $message, $context = []);
}
