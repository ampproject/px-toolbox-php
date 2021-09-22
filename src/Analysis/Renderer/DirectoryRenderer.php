<?php

namespace PageExperience\Analysis\Renderer;

use PageExperience\Analysis;

/**
 * Renderer that can render an analysis into a specific directory-based output format.
 *
 * @package ampproject/px-toolbox
 */
interface DirectoryRenderer
{

    /**
     * Render the analysis into a directory-based output format.
     *
     * @param Analysis $analysis Analysis to render.
     * @param string   $path     Path to the directory into which to render the analysis.
     * @return bool Whether rendering to the directory succeeded.
     */
    public function renderToDirectory(Analysis $analysis, $path);
}
