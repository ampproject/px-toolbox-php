<?php

namespace PageExperience\Engine\Analysis;

use JsonSerializable;

/**
 * Individual result entry of an analysis.
 *
 * @package ampproject/px-toolbox
 */
abstract class Result implements JsonSerializable
{
    /**
     * Tags associated with this result.
     *
     * @var array<string>
     */
    protected $tags = [];

    /**
     * Nested array of results to provide further details.
     *
     * @var array<Result>
     */
    protected $details = [];

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
     * Add tag to the result.
     *
     * @param string $tag Tag to add.
     * @return void
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Check whether the result has a given tag.
     *
     * @param string $tag Tag to check for.
     * @return bool Whether the result has the given tag.
     */
    public function hasTag($tag)
    {
        return in_array($tag, $this->tags, true);
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
     * Add a detail to the result.
     *
     * @param Result $detail Detail to add.
     * @return void
     */
    public function addDetail(Result $detail)
    {
        $this->details[] = $detail;
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
