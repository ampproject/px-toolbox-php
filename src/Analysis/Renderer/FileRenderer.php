<?php

namespace PageExperience\Analysis\Renderer;

use PageExperience\Analysis;

/**
 * Renderer that can render an analysis into a specific file-based output format.
 *
 * @package ampproject/px-toolbox
 */
interface FileRenderer
{

    /**
     * Render the analysis into a file-based output format.
     *
     * @param Analysis $analysis Analysis to render.
     * @param string   $filepath Path to the file into which to render the analysis.
     * @return bool Whether rendering to the file succeeded.
     */
    public function renderToFile(Analysis $analysis, $filepath);
}
