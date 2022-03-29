<?php

namespace PageExperience\Cli;

use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * PSR-3 logger for CLI commands.
 *
 * @package ampproject/px-toolbox
 */
class Logger extends AbstractLogger
{
    /**
     * Logging levels from syslog protocol defined in RFC 5424.
     *
     * @var array<string, string> $levels Logging levels.
     */
    protected static $levels = [
        LogLevel::DEBUG     => 'DEBUG',
        LogLevel::INFO      => 'INFO',
        LogLevel::NOTICE    => 'NOTICE',
        LogLevel::WARNING   => 'WARNING',
        LogLevel::ERROR     => 'ERROR',
        LogLevel::CRITICAL  => 'CRITICAL',
        LogLevel::ALERT     => 'ALERT',
        LogLevel::EMERGENCY => 'EMERGENCY',
    ];

    /**
     * File system pointer resource.
     *
     * @var resource $stream
     */
    protected $stream;

    /**
     * Class constructor.
     *
     * @param resource $stream File system pointer resource.
     */
    public function __construct($stream = STDERR)
    {
        $this->stream = $stream;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed   $level   Log level.
     * @param string  $message Log message.
     * @param mixed[] $context Log context.
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException If the log level is not valid.
     */
    public function log($level, $message, array $context = [])
    {
        if (!isset(self::$levels[$level])) {
            throw new InvalidArgumentException(
                'Level "' . $level . '" is not defined, use one of: ' . implode(', ', array_keys(static::$levels))
            );
        }

        $logLevel = self::$levels[$level];

        // @TODO Show $level and $context in the message.
        fwrite($this->stream, "[{$logLevel}] {$message}" . PHP_EOL);
    }
}
