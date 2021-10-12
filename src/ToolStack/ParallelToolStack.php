<?php

namespace PageExperience\ToolStack;

use AmpProject\Exception\NotImplemented;
use PageExperience\Analysis;
use PageExperience\ConfigurationProfile;
use PageExperience\Context;
use PageExperience\Tool;
use PageExperience\Tool\AnalysisTool;
use PageExperience\ToolStack;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Loop;

/**
 * Stack of tools that execute asynchronously and in parallel.
 *
 * @package ampproject/px-toolbox
 */
final class ParallelToolStack implements ToolStack
{

    /**
     * Array of tools to execute in sequential order.
     *
     * @var array<Tool>
     */
    private $tools;

    /**
     * Instantiate a SequentialToolStack object.
     *
     * @param Tool ...$tools Tools to execute in sequential order.
     */
    public function __construct(Tool ...$tools)
    {
        $this->tools = $tools;
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
        $analysisMerger = new AnalysisMerger($analysis);
        $contextMerger  = new ContextMerger($context);

        foreach ($this->tools as $tool) {
            if (! $tool instanceof AnalysisTool) {
                continue;
            }

            $analysisClone = clone $analysis;
            $contextClone  = clone $context;

            Loop::futureTick(
                static function () use (
                    $tool,
                    $analysisClone,
                    $url,
                    $profile,
                    $contextClone,
                    $analysisMerger,
                    $contextMerger
                ) {
                    $newAnalysis = $tool->analyze($analysisClone, $url, $profile, $contextClone);
                    $analysisMerger->collectAnalysis($newAnalysis);
                    $contextMerger->collectContext($contextClone);
                }
            );
        }

        Loop::run();

        $context->replaceWith($contextMerger->mergeContext());

        return $analysisMerger->mergeAnalysis();
    }

    /**
     * Optimize a string of HTML.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param string               $html     String of HTML to run an analysis for.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @return string String of optimized HTML.
     */
    public function optimizeHtml(Analysis $analysis, $html, ConfigurationProfile $profile, Context $context)
    {
        throw NotImplemented::forParallelOptimization();
    }

    /**
     * Optimize an HTTP response.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param ResponseInterface    $response HTTP response to optimize.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @return ResponseInterface Optimized HTTP response.
     */
    public function optimizeResponse(Analysis $analysis, $response, ConfigurationProfile $profile, Context $context)
    {
        throw NotImplemented::forParallelOptimization();
    }
}
