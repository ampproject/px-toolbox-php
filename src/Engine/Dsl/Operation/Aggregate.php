<?php

namespace PageExperience\Engine\Dsl\Operation;

use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Stack;

/**
 * Aggregate operation that executes its contained operations one after the other.
 *
 * @package ampproject/px-toolbox
 */
final class Aggregate implements Operation
{
    /**
     * Array of operations.
     *
     * @var array<Operation>
     */
    private $operations;

    /**
     * Instantiate an AggregateOperation object.
     *
     * @param array<Operation> $operations Array of operations.
     */
    public function __construct($operations)
    {
        $this->operations = $operations;
    }

    /**
     * Get the sub-operations that make up this aggregate operation.
     *
     * @return array<Operation> Sub-operations that make up this aggregate operation.
     */
    public function getSubOperations()
    {
        return $this->operations;
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
        foreach ($this->operations as $operation) {
            $operation->process($data, $stack);
        }
    }
}
