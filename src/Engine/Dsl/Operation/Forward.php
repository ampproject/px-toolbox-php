<?php

namespace PageExperience\Engine\Dsl\Operation;

use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Stack;

/**
 * Extract operation.
 *
 * @package ampproject/px-toolbox
 */
final class Forward implements Operation
{
    /**
     * Array of keys to forward.
     *
     * @var array<string>
     */
    private $keys;

    /**
     * Instantiate a Forward operation object.
     *
     * @param array<string> $keys Keys to forward.
     */
    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }

    /**
     * Process the operation on the current stack.
     *
     * @param Stack $stack Stack to process the operation on.
     * @return void
     */
    public function process(Stack $stack)
    {
        $input  = $stack->getInput();
        $output = [];

        foreach ($this->keys as $key) {
            $output[$key] = $input[$key];
        }

        $stack->addToOutput($output);
    }
}
