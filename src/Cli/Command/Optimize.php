<?php

namespace PageExperience\Cli\Command;

use AmpProject\Cli\Command;
use AmpProject\Cli\Options;
use AmpProject\Exception\Cli\InvalidArgument;
use PageExperience\Cli\Logger;
use PageExperience\Engine;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Tests\ConfiguredStubbedRemoteGetRequest;

/**
 * Commands that deal with the PX Engine Optimizer.
 *
 * @package ampproject/px-toolbox
 */
final class Optimize extends Command
{
    /**
     * Name of the command.
     *
     * @var string
     */
    const NAME = 'optimize';

    /**
     * Help text of the command.
     *
     * @var string
     */
    const HELP_TEXT = 'Run a file or a string of HTML through the PX Engine Optimizer.';

    /**
     * Register the command.
     *
     * @param Options $options Options instance to register the command with.
     * @return void
     */
    public function register(Options $options)
    {
        $options->registerCommand(self::NAME, self::HELP_TEXT);

        $options->registerArgument(
            'file',
            "Input file to run through the PX Engine Optimizer. Omit or use '-' to read from STDIN.",
            false,
            self::NAME
        );
    }

    /**
     * Process the command.
     *
     * @param Options $options Options instance to process the command with.
     * @return void
     *
     * @throws InvalidArgument If the provided file is not readable.
     */
    public function process(Options $options)
    {
        $args = $options->getArguments();

        $file = '-';

        if (count($args) > 0) {
            $file = array_shift($args);
        }

        if ($file !== '-' && (! is_file($file) || ! is_readable($file))) {
            throw InvalidArgument::forUnreadableFile($file);
        }

        if ($file === '-') {
            $file = 'php://stdin';
        }

        $html = file_get_contents($file);

        if ($html === false) {
            return;
        }

        $logger         = new Logger();
        $engine         = new Engine($logger, ConfiguredStubbedRemoteGetRequest::create());
        $profile        = new ConfigurationProfile();
        $optimizedHtml  = $engine->optimizeHtml($html, $profile);

        echo($optimizedHtml . PHP_EOL);
    }
}
