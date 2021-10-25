<?php

namespace PageExperience\Engine\Analysis\Renderer;

use PageExperience\Engine\Analysis\Renderer;
use PageExperience\Engine\Exception\InvalidRenderer;

/**
 * Renderer factory.
 *
 * @package ampproject/px-toolbox
 */
final class RendererFactory
{

    /**
     * Create a renderer instance for the requested format.
     *
     * @param string $format Format of the requested renderer.
     * @return StringRenderer|FileRenderer|DirectoryRenderer Renderer instance.
     *
     * @throws InvalidRenderer If an unknown renderer format was requested.
     */
    public function createForFormat($format)
    {
        switch ($format) {
            case Renderer::HTML:
                return new HtmlReportRenderer();
            case Renderer::JSON:
                return new JsonRenderer();
        }

        throw InvalidRenderer::forRenderer($format);
    }
}
