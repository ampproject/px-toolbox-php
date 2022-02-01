<?php

namespace PageExperience\Engine\Analysis\Result;

/**
 * Trait that provides the base logic for fulfilling the Identifiable interface.
 *
 * @package ampproject/px-toolbox
 */
trait HasIdentity
{
    /**
     * ID of the result.
     *
     * @var string
     */
    protected $id;

    /**
     * Process the provided ID.
     *
     * This can be used in the constructor to validate and store the provided ID.
     *
     * @param string $id ID to process.
     * @return void
     */
    protected function processId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the ID of the result.
     *
     * @return string ID of the result.
     */
    public function getId()
    {
        return $this->id;
    }
}
