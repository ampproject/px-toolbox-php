<?php

namespace PageExperience\Tests\Cli;

use org\bovigo\vfs\vfsStream;
use PageExperience\Cli\Logger;
use PageExperience\Tests\TestCase;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;

/**
 * Test the PageExperience\Cli\Logger class.
 *
 * @package ampproject/px-toolbox
 */
class LoggerTest extends TestCase
{
    public function testItCanBeInstantiated()
    {
        $logger = new Logger();

        self::assertInstanceOf(Logger::class, $logger);
        self::assertInstanceOf(LoggerInterface::class, $logger);
    }

    public function testLoggingException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Level "invalid" is not defined, use one of: debug, info, notice, warning, error, critical, alert, emergency');
        $logger = new Logger();
        $logger->log('invalid', 'Log message.');
    }

    public function testingLogging()
    {
        $root = vfsStream::setup();
        vfsStream::newFile('testfile')->at($root);
        $stream = fopen(vfsStream::url('root/testfile'), 'w');

        $logger = new Logger($stream);
        $logger->error('Some error message');

        $this->assertEquals('[ERROR] Some error message' . PHP_EOL, file_get_contents(vfsStream::url('root/testfile')));
    }
}
