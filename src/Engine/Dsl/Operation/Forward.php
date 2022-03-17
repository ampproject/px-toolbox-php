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
     * ID of the extract operation.
     *
     * @var string
     */
    const ID = 'forward';

    /**
     * Key-chain argument.
     *
     * @var string
     */
    const ARG_KEYS = 'keys';

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
     * @param array<string, mixed> $data  Data to process.
     * @param Stack                $stack Stack to process the operation on.
     * @return void
     */
    public function process(array $data, Stack $stack)
    {
        $input  = $stack->getInput();
        $output = [];

        foreach ($this->keys as $key) {
            $output[$key] = $input[$key];
        }

        $stack->addToOutput($output);
    }
}
