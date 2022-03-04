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
     * ID of the extract operation.
     *
     * @var string
     */
    const ID = 'extract';

    /**
     * Key-chain argument.
     *
     * @var string
     */
    const ARG_KEYCHAIN = 'key-chain';

    /**
     * Chain of nested keys to extract.
     *
     * @var array<string>
     */
    private $keyChains;

    /**
     * Instantiate an Extract operation object.
     *
     * @param array<string> $keyChains Chain of nested keys to extract.
     */
    public function __construct(array $keyChains)
    {
        $this->keyChains = $keyChains;
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
        $results = [];

        foreach ($this->keyChains as $keyChain) {
            $result = $data;
            foreach (explode('.', $keyChain) as $key) {
                $result = $result[$key];
            }
            $results = array_merge($results, (array)$result);
        }

        $stack->addToInput($results);
    }
}
