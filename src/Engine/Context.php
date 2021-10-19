<?php

namespace PageExperience\Engine;

/**
 * Context of an analysis or optimization.
 *
 * This is used for storing intermediate state, like cross-tool communication or caching.
 *
 * @package ampproject/px-toolbox
 */
final class Context
{

    /**
     * Replace the context internals with the internals of the provided Context object.
     *
     * @param Context $context Context object to use as new context internals.
     */
    public function replaceWith(Context $context)
    {
        // TODO: replace internals with the internals of the provided context.
    }
}
