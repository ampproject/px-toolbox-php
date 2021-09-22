<?php

namespace PageExperience\Analysis\Renderer;

use PageExperience\Analysis;

/**
 * JSON format renderer.
 *
 * @package ampproject/px-toolbox
 */
final class JsonRenderer implements StringRenderer, FileRenderer
{

    /**
     * Render the analysis into a file-based output format.
     *
     * @param Analysis $analysis Analysis to render.
     * @param string   $filepath Path to the file into which to render the analysis.
     * @return bool Whether rendering to the file succeeded.
     */
    public function renderToFile(Analysis $analysis, $filepath)
    {
        $json = $this->renderToString($analysis);

        // TODO: Add safeguards.

        return (bool) file_put_contents($filepath, $json);
    }

    /**
     * Render the analysis into a string-based output format.
     *
     * @param Analysis $analysis Analysis to render.
     * @return string String-based output.
     */
    public function renderToString(Analysis $analysis)
    {
        $json = json_encode($analysis);

        // TODO: Add safeguards.

        return $json;
    }
}
