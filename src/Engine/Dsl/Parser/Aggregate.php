<?php

namespace PageExperience\Engine\Dsl\Parser;

use PageExperience\Engine\Dsl\Operation;
use PageExperience\Engine\Dsl\Parser;
use PageExperience\Engine\Dsl\ParserFactory;

/**
 * Aggregate parser for multiple DSLs.
 *
 * @package ampproject/px-toolbox
 */
final class Aggregate implements Parser
{
    /**
     * DSLs to parse.
     *
     * @var array<string, mixed>
     */
    private $dsls;

    /**
     * Instantiate an aggregate parser object.
     *
     * @param array<string, mixed> $dsls DSLs to parse.
     */
    public function __construct(array $dsls)
    {
        $this->dsls = $dsls;
    }

    /**
     * Parse the DSL(s) into an expression hierarchy.
     *
     * @return Operation
     */
    public function parse()
    {
        $operations    = [];
        $parserFactory = new ParserFactory();

        foreach ($this->dsls as $dsl) {
            $specificParser = $parserFactory->createSpecificParser($dsl);
            $operations[]   = $specificParser->parse();
        }

        return new Operation\Aggregate($operations);
    }
}
