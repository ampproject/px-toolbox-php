<?php

namespace PageExperience\Engine\Analysis;

/**
 * Interface with constant names for the known formats.
 *
 * @package ampproject/px-toolbox
 */
interface Renderer
{
    /**
     * HTML report renderer.
     *
     * Supports directory output.
     *
     * @var string
     */
    const HTML = 'html';

    /**
     * JSON-based renderer.
     *
     * Supports string and file outputs.
     *
     * @var string
     */
    const JSON = 'json';
}
