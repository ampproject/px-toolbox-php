<?php

namespace PageExperience\Engine\Tool;

use AmpProject\RemoteGetRequest;
use PageExperience\Engine\Analysis;
use PageExperience\Engine\Analysis\Result\ScoredMetric;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Exception\MissingResultDataKey;
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
     * Array of scored metric keys.
     *
     * @var array<string>
     */
    const SCORED_METRIC_KEYS = [
        'numericValue',
        'numericUnit',
        'displayValue',
        'score',
        'scoreDisplayMode'
    ];

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

        foreach ($lighthouseAudit['audits'] as $result) {
            $this->processResult($analysis, $result);
        }

        return $analysis;
    }

    /**
     * Process the lighthouse audit result.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param array<string, mixed> $result   Associative array of result data.
     * @return void
     */
    private function processResult(Analysis $analysis, $result)
    {
        if (! array_key_exists('id', $result)) {
            var_dump($result);
            return;
        }

        $id = $result['id'];
        unset($result['id']);

        switch ($id) {
            // Metrics.
            case 'cumulative-layout-shift':
            case 'first-contentful-paint':
            case 'first-contentful-paint-3g':
            case 'first-meaningful-paint':
            case 'interactive':
            case 'largest-contentful-paint':
            case 'max-potential-fid':
            case 'speed-index':
            case 'total-blocking-time':
                $parsedResult = $this->parseScoredMetric($id, $result);
                $analysis->addResult($parsedResult);
                break;

            case 'bootup-time':
            case 'critical-request-chains':
            case 'diagnostics':
            case 'dom-size':
            case 'duplicated-javascript':
            case 'efficient-animated-content':
            case 'final-screenshot':
            case 'font-display':
            case 'full-page-screenshot':
            case 'largest-contentful-paint-element':
            case 'layout-shift-elements':
            case 'legacy-javascript':
            case 'long-tasks':
            case 'main-thread-tasks':
            case 'mainthread-work-breakdown':
            case 'metrics':
            case 'modern-image-formats':
            case 'network-requests':
            case 'network-rtt':
            case 'network-server-latency':
            case 'no-document-write':
            case 'non-composited-animations':
            case 'offscreen-images':
            case 'performance-budget':
            case 'preload-lcp-image':
            case 'redirects':
            case 'render-blocking-resources':
            case 'resource-summary':
            case 'screenshot-thumbnails':
            case 'script-treemap-data':
            case 'server-response-time':
            case 'third-party-facades':
            case 'third-party-summary':
            case 'timing-budget':
            case 'total-byte-weight':
            case 'unminified-css':
            case 'unminified-javascript':
            case 'unsized-images':
            case 'unused-css-rules':
            case 'unused-javascript':
            case 'user-timings':
            case 'uses-long-cache-ttl':
            case 'uses-optimized-images':
            case 'uses-passive-event-listeners':
            case 'uses-rel-preconnect':
            case 'uses-rel-preload':
            case 'uses-responsive-images':
            case 'uses-text-compression':
            default:
        }
    }

    /**
     * Parse result data as a scored metric.
     *
     * @param string               $id     ID of the result.
     * @param array<string, mixed> $result Associative array of result data.
     * @return ScoredMetric Scored metric result object.
     *
     * @throws MissingResultDataKey If a key is missing from the audit result.
     */
    private function parseScoredMetric($id, $result)
    {
        $arguments = [];

        foreach (self::SCORED_METRIC_KEYS as $key) {
            if (! array_key_exists($key, $result)) {
                throw MissingResultDataKey::forKey($id, $key);
            }

            $arguments[] = $result[$key];
        }

        $label       = array_key_exists('title', $result) ? $result['title'] : $id;
        $description = array_key_exists('description', $result) ? $result['description'] : '';

        return new ScoredMetric($id, $label, $description, ...$arguments);
    }
}
