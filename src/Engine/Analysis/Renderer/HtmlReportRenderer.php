<?php

namespace PageExperience\Engine\Analysis\Renderer;

use PageExperience\Engine\Analysis;

/**
 * HTML report renderer.
 *
 * @package ampproject/px-toolbox
 */
final class HtmlReportRenderer implements DirectoryRenderer
{

    /**
     * Render the analysis into a directory-based output format.
     *
     * @param Analysis $analysis Analysis to render.
     * @param string   $path     Path to the directory into which to render the analysis.
     * @return bool Whether rendering to the directory succeeded.
     */
    public function renderToDirectory(Analysis $analysis, $path)
    {
        // TODO: Implement renderToDirectory() method.

        return false;
    }
}
