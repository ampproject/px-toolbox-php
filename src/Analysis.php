<?php

namespace PageExperience;

use PageExperience\Analysis\Result;
use PageExperience\Analysis\Ruleset;
use PageExperience\Analysis\Scope;
use PageExperience\Analysis\Status;
use PageExperience\Analysis\Timestamp;

/**
 * Page experience analysis.
 *
 * An analysis is made up of multiple, nested analysis result entries.
 *
 * @package ampproject/px-toolbox
 */
interface Analysis
{

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
}
