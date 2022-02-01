<?php

namespace PageExperience\Engine\ToolStack;

use PageExperience\Engine\Context;

/**
 * Helper object to merge multiple contexts into a single context.
 *
 * This is mainly used to consolidate results from parallel executions.
 *
 * @package ampproject/px-toolbox
 */
final class ContextMerger
{
    /**
     * Collection of contexts.
     *
     * @var array<Context>
     */
    private $contextCollection = [];

    /**
     * Instantiate a ContextMerger object.
     *
     * @param Context|null $context Optional. Starting context to use.
     */
    public function __construct(Context $context = null)
    {
        if ($context instanceof Context) {
            $this->collectContext($context);
        }
    }

    /**
     * Collect a new context.
     *
     * @param Context $context Context to collect.
     * @return void
     */
    public function collectContext(Context $context)
    {
        $this->contextCollection[] = $context;
    }

    /**
     * Merge all collected contexts into a single context.
     *
     * @return Context
     */
    public function mergeContext()
    {
        // TODO: Consolidate multiple contexts.

        return $this->contextCollection[0];
    }
}
