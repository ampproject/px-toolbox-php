<?php

namespace PageExperience\Engine\Dsl;

/**
 * Interface for a single operation in a DSL expression.
 *
 * @package ampproject/px-toolbox
 */
interface Operation
{
    /**
     * Process the operation on the current stack.
     *
     * @param Stack $stack Stack to process the operation on.
     * @return void
     */
    public function process(Stack $stack);
}
