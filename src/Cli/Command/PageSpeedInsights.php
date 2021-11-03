<?php

namespace PageExperience\Cli\Command;

use AmpProject\Cli\Command;
use AmpProject\Cli\Options;
use AmpProject\Cli\TableFormatter;
use AmpProject\Exception\Cli\InvalidArgument;
use PageExperience\PageSpeed\PageSpeedInsightsApi;

/**
 * Run a PageSpeed Insights audit.
 *
 * @package ampproject/px-toolbox
 */
final class PageSpeedInsights extends Command
{

    /**
     * Name of the command.
     *
     * @var string
     */
    const NAME = 'psi';

    /**
     * Help text of the command.
     *
     * @var string
     */
    const HELP_TEXT = 'Run a PageSpeed Insights audit.';

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
            'URL to run the PageSpeed Insights audit against.',
            true,
            self::NAME
        );

        $options->registerOption(
            'key',
            'Google API key to use.',
            null,
            true,
            self::NAME
        );

        $options->registerOption(
            'strategy',
            'PageSpeed Insights strategy to use (desktop/mobile). Defaults to mobile.',
            null,
            true,
            self::NAME
        );

        $options->registerOption(
            'referrer',
            'Referrer to use. Defaults to https://example.com/.',
            null,
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
        $key       = (string) $options->getOption('key');
        $json      = (bool) $options->getOption('json');
        $strategy  = (string) $options->getOption('strategy', 'mobile');
        $referrer  = (string) $options->getOption('referrer', 'https://example.com/');

        $psi     = new PageSpeedInsightsApi($key);
        $results = $psi->audit($url, $strategy, $referrer);

        if ($json) {
            echo json_encode($results) . PHP_EOL;
            return;
        }

        $tableFormatter = new TableFormatter();
        $tableFormatter->setBorder(' | ');

        $rows = [
            [
                'Performance',
                'Largest Contentful Paint',
                'First Contentful Paint',
                'Cumulative Layout Shift',
            ],
            [
                $results['lighthouseResult']['categories']['performance']['score'] * 100,
                sprintf(
                    '%d (%s)',
                    $results['lighthouseResult']['audits']['largest-contentful-paint']['score'] * 100,
                    $results['lighthouseResult']['audits']['largest-contentful-paint']['displayValue']
                ),
                sprintf(
                    '%d (%s)',
                    $results['lighthouseResult']['audits']['first-contentful-paint']['score'] * 100,
                    $results['lighthouseResult']['audits']['first-contentful-paint']['displayValue']
                ),
                sprintf(
                    '%d (%s)',
                    $results['lighthouseResult']['audits']['cumulative-layout-shift']['score'] * 100,
                    $results['lighthouseResult']['audits']['cumulative-layout-shift']['displayValue']
                ),
            ],
        ];

        $horizontalBorder = '+' . implode('+', array_pad([], 4, str_repeat('-', 26))) . "+\n";

        echo $horizontalBorder;
        foreach ($rows as $row) {
            $row[0] = '| ' . $row[0];
            $row[3] = str_pad($row[3], 24, ' ') . ' |';
            echo $tableFormatter->format([ '26', '24', '24', '26'], $row);
        }
        echo $horizontalBorder;
    }
}
