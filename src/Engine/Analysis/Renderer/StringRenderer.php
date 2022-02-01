<?php

namespace PageExperience\Engine\Analysis\Renderer;

use PageExperience\Engine\Analysis;

/**
 * Renderer that can render an analysis into a specific string-based output format.
 *
 * @package ampproject/px-toolbox
 */
interface StringRenderer
{
    /**
     * Render the analysis into a string-based output format.
     *
     * @param Analysis $analysis Analysis to render.
     * @return string String-based output.
     */
    public function renderToString(Analysis $analysis);
}
