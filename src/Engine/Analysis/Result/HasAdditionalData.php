<?php

namespace PageExperience\Engine\Analysis\Result;

/**
 * Trait that can optionally accept additional data.
 *
 * @package ampproject/px-toolbox
 */
trait HasAdditionalData
{
    /**
     * Additional data for the result.
     *
     * @var array|null
     */
    protected $additionalData;

    /**
     * Process the provided additional data.
     *
     * This can be used in the constructor to validate and store the provided additional data.
     *
     * @param array|null $additionalData Additional data to process. Null if none.
     */
    protected function processAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }

    /**
     * Check whether the result has additional data.
     *
     * @return bool Whether the result has additional data.
     */
    public function hasAdditionalData()
    {
        return $this->additionalData !== null;
    }

    /**
     * Get the additional data of the result.
     *
     * @return array|null AdditionalData of the result.
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }
}
