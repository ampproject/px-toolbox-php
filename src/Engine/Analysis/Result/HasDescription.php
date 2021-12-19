<?php

namespace PageExperience\Engine\Analysis\Result;

/**
 * Trait that provides the base implementation for offering a description.
 *
 * @package ampproject/px-toolbox
 */
trait HasDescription
{
    /**
     * Description of the result.
     *
     * @var string
     */
    protected $description;

    /**
     * Process the provided description.
     *
     * This can be used in the constructor to validate and store the provided description.
     *
     * @param string $description Description to process.
     */
    protected function processDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get the description of the result.
     *
     * @return string Description of the result.
     */
    public function getDescription()
    {
        return $this->description;
    }
}
