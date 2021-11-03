<?php

namespace PageExperience\Engine\Analysis;

/**
 * Interface for an analysis result being identifiable.
 *
 * @package ampproject/px-toolbox
 */
interface Identifiable
{

    /**
     * Get the ID of the result.
     *
     * @return string ID of the result.
     */
    public function getId();
}
