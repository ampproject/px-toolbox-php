<?php

namespace PageExperience\Engine\Dsl\Operation;

use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Stack;
use PageExperience\Engine\Dsl\ToolSpecific;

/**
 * Rule collection operation that uses field IDs to separate operations into multiple rules.
 *
 * @package ampproject/px-toolbox
 */
final class RuleCollection implements Operation, ToolSpecific
{
    /**
     * Name of the tool that this rule collection is for.
     *
     * @var string
     */
    private $toolName;

    /**
     * Associative array of operations.
     *
     * @var array<string, Operation>
     */
    private $operations;

    /**
     * Instantiate a RuleCollectionOperation object.
     *
     * @param string                   $toolName   Name of the tool that this rule collection is for.
     * @param array<string, Operation> $operations Associative array of operations.
     */
    public function __construct($toolName, $operations)
    {
        $this->toolName   = $toolName;
        $this->operations = $operations;
    }

    /**
     * Get the name of the tool that this is for.
     *
     * @return string Name of the tool that this is for.
     */
    public function getToolName()
    {
        return $this->toolName;
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

    /**
     * Merge the current rule collection with the provided rule collection.
     *
     * @param RuleCollection $ruleCollection Rule collection to merge into the current one.
     * @return RuleCollection New rule collection that is a merging between the two previous ones.
     */
    public function mergeWith(RuleCollection $ruleCollection)
    {
        $newRuleCollection = clone $this;

        foreach ($ruleCollection->operations as $field => $operation) {
            $newRuleCollection->operations[$field] = $operation;
        }

        return $newRuleCollection;
    }
}
