<?php

namespace PageExperience\Engine\Tool;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Tool\AmpValidator\Ruleset;
use Psr\Log\LoggerInterface;

/**
 * AMP Validator abstraction as a page experience tool.
 *
 * @package ampproject/px-toolbox
 */
final class AmpValidator implements AnalysisTool, Configurable
{
    /**
     * Name of the tool.
     *
     * @var string
     */
    const NAME = 'amp-validator';

    /**
     * Logs that are collected during engine processes.
     *
     * @TODO Use the logger to collect the logs during processing.
     *
     * @var LoggerInterface
     */
    private $logger; /* @phpstan-ignore-line */

    /**
     * Ruleset the tool is to be configured with.
     *
     * @var ToolRuleset
     */
    private $toolRuleset;

    /**
     * Instantiate a AmpValidator tool instance.
     *
     * @param LoggerInterface $logger Logs that are collected during engine processes.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Get the name of the tool.
     *
     * @return string Name of the tool.
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * Get the FQCN of the tool's ruleset object.
     *
     * @return class-string<ToolRuleset> FQCN of the tool's ruleset object.
     */
    public function getRulesetFqcn()
    {
        return Ruleset::class;
    }

    /**
     * Configure the tool with a given ruleset.
     *
     * @param ToolRuleset $toolRuleset Ruleset to configure the tool with.
     * @return void
     */
    public function configureWithRuleset(ToolRuleset $toolRuleset)
    {
        $this->toolRuleset = $toolRuleset;
    }

    /**
     * Analyze a URL.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param string               $url      URL to run an analysis for.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @return Analysis Adapted page experience analysis.
     */
    public function analyze(
        Analysis $analysis,
        $url,
        ConfigurationProfile $profile,
        Context $context
    ) {
        $this->toolRuleset->configureTool($this);

        // TODO: Implement analyze() method.

        return $analysis;
    }
}
