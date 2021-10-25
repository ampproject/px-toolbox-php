<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\Analysis;
use PageExperience\Engine\ConfigurationProfile;
use PageExperience\Engine\Context;
use PageExperience\Engine\Exception\NotImplemented;
use PageExperience\Engine\Tool\AnalysisTool;
use PageExperience\Engine\Tool\OptimizationTool;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Loop;

/**
 * Stack of tools that execute asynchronously and in parallel.
 *
 * @package ampproject/px-toolbox
 */
final class ParallelToolStack extends BaseToolStack
{

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
     * @throws NotImplemented If multiple tools are meant to optimize in parallel.
     */
    public function optimizeHtml(Analysis $analysis, $html, ConfigurationProfile $profile, Context $context)
    {
        /** @var array<OptimizationTool> $optimizationTools */
        $optimizationTools = array_filter(
            $this->tools,
            static function ($tool) {
                return $tool instanceof OptimizationTool;
            }
        );

        if (count($optimizationTools) > 1) {
            throw NotImplemented::forParallelOptimization();
        }

        return $optimizationTools[0]->optimizeHtml($analysis, $html, $profile, $context);
    }

    /**
     * Optimize an HTTP response.
     *
     * @param Analysis             $analysis Current state of the analysis.
     * @param ResponseInterface    $response HTTP response to optimize.
     * @param ConfigurationProfile $profile  Configuration profile to use for the analysis.
     * @param Context              $context  Current context of the analysis.
     * @return ResponseInterface Optimized HTTP response.
     * @throws NotImplemented If multiple tools are meant to optimize in parallel.
     */
    public function optimizeResponse(
        Analysis $analysis,
        ResponseInterface $response,
        ConfigurationProfile $profile,
        Context $context
    ) {
        /** @var array<OptimizationTool> $optimizationTools */
        $optimizationTools = array_filter(
            $this->tools,
            static function ($tool) {
                return $tool instanceof OptimizationTool;
            }
        );

        if (count($optimizationTools) > 1) {
            throw NotImplemented::forParallelOptimization();
        }

        return $optimizationTools[0]->optimizeResponse($analysis, $response, $profile, $context);
    }
}
