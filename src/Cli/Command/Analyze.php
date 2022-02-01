<?php

namespace PageExperience\Cli\Command;

use AmpProject\Cli\Command;
use AmpProject\Cli\Options;
use AmpProject\Cli\TableFormatter;
use AmpProject\Exception\Cli\InvalidArgument;
use PageExperience\Engine;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\PageSpeed\PageSpeedInsightsApi;
use PageExperience\Tests\ConfiguredStubbedRemoteGetRequest;

/**
 * Run a Page Experience Engine analysis.
 *
 * @package ampproject/px-toolbox
 */
final class Analyze extends Command
{
    /**
     * Name of the command.
     *
     * @var string
     */
    const NAME = 'analyze';

    /**
     * Help text of the command.
     *
     * @var string
     */
    const HELP_TEXT = 'Run a Page Experience Engine analysis.';

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
            'url',
            'URL to run the Page Experience Engine analysis against.',
            true,
            self::NAME
        );

        $options->registerOption(
            'json',
            'Output raw JSON result.',
            null,
            false,
            self::NAME
        );
    }

    /**
     * Process the command.
     *
     * Arguments and options have been parsed when this is run.
     *
     * @param Options $options Options instance to process the command with.
     * @return void
     *
     * @throws InvalidArgument If the provided file is not readable.
     */
    public function process(Options $options)
    {
        list($url) = $options->getArguments();
        $json      = (bool) $options->getOption('json');

        $engine  = new Engine(ConfiguredStubbedRemoteGetRequest::create());
        $profile = new ConfigurationProfile();

        $analysis = $engine->analyze($url, $profile);

        if ($json) {
            $renderer = new Analysis\Renderer\JsonRenderer();
            echo $renderer->renderToString($analysis) . PHP_EOL;
        } else {
            // TODO: This is only a summary for now.
            /** @var array<Analysis\Result\ScoredMetric> $metrics */
            $metrics = $analysis->getResultsOfType(Analysis\Result\ScoredMetric::class);
            foreach ($metrics as $metric) {
                $this->cli->info(
                    sprintf('%s: %0.2f (%s)', $metric->getLabel(), $metric->getScore(), $metric->getDisplayValue())
                );
            }
        }

        if ($analysis->getStatus()->equals(Analysis\Status::ERROR())) {
            exit(1);
        }

        exit(0);
    }
}
