<?php

namespace PageExperience\Engine;

use JsonSerializable;
use PageExperience\Engine\Analysis\Result;
use PageExperience\Engine\Analysis\Ruleset;
use PageExperience\Engine\Analysis\Scope;
use PageExperience\Engine\Analysis\Status;
use PageExperience\Engine\Analysis\Timestamp;

/**
 * Page experience analysis.
 *
 * An analysis is made up of multiple, nested analysis result entries.
 *
 * @package ampproject/px-toolbox
 */
interface Analysis extends JsonSerializable
{
    /**
     * Add an individual result to the analysis.
     *
     * @param Result $result Individual result to add to the analysis.
     * @return void
     */
    public function addResult(Result $result);

    /**
     * Get the status of the analysis.
     *
     * @return Status Status of the analysis.
     */
    public function getStatus();

    /**
     * Get the timestamp of the analysis run.
     *
     * @return Timestamp Timestamp of the analysis run.
     */
    public function getTimestamp();

    /**
     * Get the scope of the analysis run.
     *
     * @return Scope Scope of the analysis run.
     */
    public function getScope();

    /**
     * Get the ruleset of the analysis run.
     *
     * @return Ruleset Ruleset of the analysis run.
     */
    public function getRuleset();

    /**
     * Get the results of the analysis run.
     *
     * @return array<Result> Results of the analysis run.
     */
    public function getResults();

    /**
     * Get the results of the analysis run.
     *
     * @param class-string<Result> $type Type of result to fetch.
     * @return array<Result> Filtered results of the analysis run.
     */
    public function getResultsOfType($type);
}
