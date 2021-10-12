<?php

namespace PageExperience\ToolStack;

use PageExperience\Analysis;

/**
 * Helper object to merge multiple analysis results into a single analysis result.
 *
 * This is mainly used to consolidate results from parallel executions.
 *
 * @package ampproject/px-toolbox
 */
final class AnalysisMerger
{

    /**
     * Collection of analysis results.
     *
     * @var array<Analysis>
     */
    private $analysisCollection = [];

    /**
     * Instantiate an AnalysisMerger object.
     *
     * @param Analysis|null $analysis Optional. Starting analysis result to use.
     */
    public function __construct(Analysis $analysis = null)
    {
        if ($analysis instanceof Analysis) {
            $this->collectAnalysis($analysis);
        }
    }

    /**
     * Collect a new analysis result.
     *
     * @param Analysis $analysis Analysis result to collect.
     */
    public function collectAnalysis(Analysis $analysis)
    {
        $this->analysisCollection[] = $analysis;
    }

    /**
     * Merge all collected analysis results into a single analysis result.
     *
     * @return Analysis
     */
    public function mergeAnalysis()
    {
        // TODO: Consolidate multiple analysis results.

        return $this->analysisCollection[0];
    }
}
