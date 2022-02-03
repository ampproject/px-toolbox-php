<?php

namespace PageExperience\Tests\Cli;

use AmpProject\Cli\Command;
use AmpProject\Cli\Executable;
use AmpProject\Cli\Options;
use AmpProject\Exception\Cli\InvalidArgument;
use org\bovigo\vfs\vfsStream;
use PageExperience\Cli\Command\Optimize;
use PageExperience\Tests\TestCase;

/**
 * Test the PageExperience\Cli\Command\Optimize class.
 *
 * @package ampproject/px-toolbox
 */
final class OptimizeTest extends TestCase
{
    public function testInstantiation()
    {
        $executable = $this->createMock(Executable::class);

        $command = new Optimize($executable);

        $this->assertInstanceOf(Command::class, $command);
        $this->assertEquals('optimize', $command->getName());
    }

    public function testRegistration()
    {
        $executable = $this->createMock(Executable::class);
        $options    = $this->createMock(Options::class);
        $options->expects($this->once())
                ->method('registerCommand')
                ->with($this->equalTo('optimize'));
        $options->expects($this->once())
                ->method('registerArgument')
                ->with($this->equalTo('file'));

        $command = new Optimize($executable);
        $command->register($options);
    }

    public function testProcessing()
    {
        $root = vfsStream::setup();
        $file = vfsStream::newFile('input.html')
            ->withContent('<amp-img src="image.jpg" width="500" height="500">')
            ->at($root);

        $executable = $this->createMock(Executable::class);
        $options    = $this->createMock(Options::class);

        $command = new Optimize($executable);
        $command->register($options);
        $options->expects($this->once())
                ->method('getArguments')
                ->willReturn([$file->url()]);

        ob_start();
        $command->process($options);
        $output = ob_get_clean();

        $this->assertStringContainsString('transformed="self;v=1"', $output);
    }

    public function testUnreadableFileThrowsError()
    {
        $root = vfsStream::setup();
        $file = vfsStream::newFile('input.html')->at($root)->chmod(000);

        $executable = $this->createMock(Executable::class);
        $options    = $this->createMock(Options::class);

        $command = new Optimize($executable);
        $command->register($options);
        $options->expects($this->once())
                ->method('getArguments')
                ->willReturn([$file->url()]);

        $this->expectException(InvalidArgument::class);

        $command->process($options);
    }
}
