<?php

namespace PageExperience\Engine\Dsl\Operation;

use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Stack;

/**
 * Rule collection operation that uses field IDs to separate operations into multiple rules.
 *
 * @package ampproject/px-toolbox
 */
final class RuleCollection implements Operation
{
    /**
     * Associative array of operations.
     *
     * @var array<string, Operation>
     */
    private $operations;

    /**
     * Instantiate a RuleCollectionOperation object.
     *
     * @param array<string, Operation> $operations Associative array of operations.
     */
    public function __construct($operations)
    {
        $this->operations = $operations;
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
        foreach ($this->operations as $field => $operation) {
            $subStack = new Stack();
            $operation->process($data, $subStack);
            $stack->addToOutput([$field => $subStack->getOutput()]);
        }
    }
}
