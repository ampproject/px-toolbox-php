<?php

namespace PageExperience\Engine\Analysis;

use PageExperience\Engine\Analysis;

/**
 * Analysis as collected by the page experience engine.
 *
 * @package ampproject/px-toolbox
 */
final class PageExperienceAnalysis implements Analysis
{

    /**
     * Status of the analysis.
     *
     * @var Status
     */
    private $status;

    /**
     * Timestamp of the analysis run.
     *
     * @var Timestamp
     */
    private $timestamp;

    /**
     * Scope of the analysis run.
     *
     * @var Scope
     */
    private $scope;

    /**
     * Ruleset used for the analysis.
     *
     * @var Ruleset
     */
    private $ruleset;

    /**
     * Results produced by the analysis.
     *
     * @var array<Result>
     */
    private $results;

    /**
     * Instantiate a PageExperienceAnalysis object.
     *
     * @param Status        $status    Optional. Status of the analysis.
     * @param Timestamp     $timestamp Optional. Timestamp of the analysis run.
     * @param Scope         $scope     Optional. Scope of the analysis run.
     * @param Ruleset       $ruleset   Optional. Ruleset used for the analysis.
     * @param array<Result> $results   Optional. Results produced by the analysis.
     */
    public function __construct(
        Status $status = null,
        Timestamp $timestamp = null,
        Scope $scope = null,
        Ruleset $ruleset = null,
        $results = []
    ) {
        $this->status = $status ?: Status::UNKNOWN();
        $this->timestamp = $timestamp ?: Timestamp::now();
        $this->scope = $scope ?: Scope::PAGE();
        $this->ruleset = $ruleset ?: new Ruleset('L1');
        array_map([$this, 'addResult'], $results);
    }

    /**
     * Add an individual result to the analysis.
     *
     * @param Result $result Individual result to add to the analysis.
     * @return void
     */
    public function addResult(Result $result)
    {
        $this->results[] = $result;
    }

    /**
     * Get the status of the analysis.
     *
     * @return Status Status of the analysis.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the timestamp of the analysis run.
     *
     * @return Timestamp Timestamp of the analysis run.
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the scope of the analysis run.
     *
     * @return Scope Scope of the analysis run.
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Get the ruleset of the analysis run.
     *
     * @return Ruleset Ruleset of the analysis run.
     */
    public function getRuleset()
    {
        return $this->ruleset;
    }

    /**
     * Get the results of the analysis run.
     *
     * @return array<Result> Results of the analysis run.
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Serialize into JSON.
     *
     * @return mixed Data to be serialized into JSON.
     */
    public function jsonSerialize()
    {
        return [
            'status'    => (string) $this->getStatus()->getKey(),
            'timestamp' => (string) $this->getTimestamp(),
            'scope'     => (string) $this->getScope()->getKey(),
            'ruleset'   => (string) $this->getRuleset()->getName(),
            'results'   => $this->getResults(),
        ];
    }
}
