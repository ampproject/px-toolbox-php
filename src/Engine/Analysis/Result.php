<?php

namespace PageExperience\Engine\Analysis;

/**
 * Individual result entry of an analysis.
 *
 * @package ampproject/px-toolbox
 */
abstract class Result
{

    /**
     * Tags associated with this result.
     *
     * @var array<string>
     */
    private $tags = [];

    /**
     * Nested array of results to provide further details.
     *
     * @var array<Result>
     */
    private $details = [];

    /**
     * Get the tags associated with this result.
     *
     * @return string[] Tags associated with this result.
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get the details for this result.
     *
     * @return array<Result>
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Get the label for this result.
     *
     * @return string Label for this result.
     */
    abstract public function getLabel();

    /**
     * Get the description for this result.
     *
     * @return string Description for this result.
     */
    abstract public function getDescription();
}
