<?php

namespace PageExperience\Engine\Analysis\Result;

/**
 * Trait that provides the base implementation for offering a label.
 *
 * @package ampproject/px-toolbox
 */
trait HasLabel
{
    /**
     * Label of the result.
     *
     * @var string
     */
    protected $label;

    /**
     * Process the provided label.
     *
     * This can be used in the constructor to validate and store the provided label.
     *
     * @param string $label Label to process.
     */
    protected function processLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get the label of the result.
     *
     * @return string Label of the result.
     */
    public function getLabel()
    {
        return $this->label;
    }
}
