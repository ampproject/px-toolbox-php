<?php

namespace PageExperience\Engine\Tool;

use AmpProject\RemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Exception\ToolRulesetMismatch;
use PageExperience\Engine\Tool\Lighthouse\Ruleset;
use PageExperience\PageSpeed\PageSpeedInsightsApi;

/**
 * Lighthouse abstraction as a page experience tool.
 *
 * @package ampproject/px-toolbox
 */
final class Lighthouse implements AnalysisTool, Configurable
{

    /**
     * Name of the tool.
     *
     * @var string
     */
    const NAME = 'lighthouse';

    /**
     * Context key under which to store the lighthouse audit in the context.
     *
     * @var string
     */
    const LIGHTHOUSE_AUDIT_CONTEXT_KEY = 'lighthouse_audit';

    /**
     * Remote request handler instance to use.
     *
     * @var RemoteGetRequest
     */
    private $remoteRequest;

    /**
     * Ruleset the tool is to be configured with.
     *
     * @var Ruleset
     */
    private $toolRuleset;

    /**
     * Instantiate a Lighthouse tool instance.
     *
     * @param RemoteGetRequest $remoteRequest Remote request handler instance to use.
     */
    public function __construct(RemoteGetRequest $remoteRequest)
    {
        $this->remoteRequest = $remoteRequest;
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
     * @throws ToolRulesetMismatch If the FQCN of the ruleset does not match.
     */
    public function configureWithRuleset(ToolRuleset $toolRuleset)
    {
        if (! $toolRuleset instanceof Ruleset) {
            throw ToolRulesetMismatch::forToolRulesetClassMismatch($this, $toolRuleset, Ruleset::class);
        }

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
    public function analyze(Analysis $analysis, $url, ConfigurationProfile $profile, Context $context)
    {
        $psiApi = new PageSpeedInsightsApi($this->toolRuleset->getPsiApiKey(), $this->remoteRequest);

        $psiAudit = $psiApi->audit(
            $url,
            $this->toolRuleset->getStrategy()->getValue(),
            $this->toolRuleset->getReferrer()
        );

        $lighthouseAudit = $psiAudit['lighthouseResult'];

        $context->add(self::LIGHTHOUSE_AUDIT_CONTEXT_KEY, $lighthouseAudit);

        foreach ($lighthouseAudit['audits'] as $issue) {
            $analysis->addResult(new Analysis\Issue($issue['id'], $issue['title'], $issue['description']));
        }
        var_dump($analysis);

        // TODO: Parse audit JSON into Analysis object tree.

        return $analysis;
    }
}
