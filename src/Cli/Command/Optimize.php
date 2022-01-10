<?php

namespace PageExperience\Cli\Command;

use AmpProject\Cli\Command;
use AmpProject\Cli\Options;
use AmpProject\Optimizer\ErrorCollection;
use AmpProject\Exception\Cli\InvalidArgument;
use AmpProject\Optimizer\TransformationEngine;

/**
 * Commands that deal with the AMP optimizer.
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
    const HELP_TEXT = 'Run a file or HTML through the AMP Optimizer.';

    /**
     * Register the command.
     *
     * @param Options $options Options instance to register the command with.
     */
    public function register(Options $options)
    {
        $options->registerCommand(self::NAME, self::HELP_TEXT);

        $options->registerArgument(
            'file',
            "Input file to run through the AMP Optimizer. Omit or use '-' to read from STDIN.",
            false,
            self::NAME
        );
    }

    /**
     * Process the command.
     *
     * @param Options $options Options instance to process the command with.
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

        $html                  = file_get_contents($file);
        $errors                = new ErrorCollection();
        $transformation_engine = new TransformationEngine();
        $optimized_html        = $transformation_engine->optimizeHtml($html, $errors);

        fwrite(STDOUT, $optimized_html);

        /** @var Error $error */
        foreach ($errors as $error) {
            $this->cli->warning("[{$error->getCode()}] {$error->getMessage()}");
        }
    }
}
