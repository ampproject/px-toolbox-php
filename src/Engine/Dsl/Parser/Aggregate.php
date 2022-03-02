<?php

namespace PageExperience\Engine\Dsl\Parser;

use PageExperience\Engine\Dsl\Expression;
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
     * Parse the DSL(s) into an object hierarchy.
     *
     * @return array<Expression>
     */
    public function parse()
    {
        $expressions = [];
        $parserFactory = new ParserFactory();

        foreach ($this->dsls as $dsl) {
            $specificParser = $parserFactory->createSpecificParser($dsl);
            $expressions    = array_merge($expressions, $specificParser->parse());
        }

        return $expressions;
    }
}
