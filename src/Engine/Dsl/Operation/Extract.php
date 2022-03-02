<?php

namespace PageExperience\Engine\Dsl\Operation;

use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Stack;

/**
 * Extract operation.
 *
 * @package ampproject/px-toolbox
 */
final class Extract implements Operation
{
    /**
     * Data to extract from.
     *
     * @var array<string, mixed>
     */
    private $data;

    /**
     * Chain of nested keys to extract.
     *
     * @var array<string>
     */
    private $keyChains;

    /**
     * Instantiate an Extract operation object.
     *
     * @param array<string, mixed> $data      Data to extract from.
     * @param array<string>        $keyChains Chain of nested keys to extract.
     */
    public function __construct(array $data, array $keyChains)
    {
        $this->data      = $data;
        $this->keyChains = $keyChains;
    }

    /**
     * Process the operation on the current stack.
     *
     * @param Stack $stack Stack to process the operation on.
     * @return void
     */
    public function process(Stack $stack)
    {
        $results = [];

        foreach ($this->keyChains as $keyChain) {
            $result = $this->data;
            foreach (explode('.', $keyChain) as $key) {
                $result = $result[$key];
            }
            $results = array_merge($results, (array)$result);
        }

        $stack->addToInput($results);
    }
}
