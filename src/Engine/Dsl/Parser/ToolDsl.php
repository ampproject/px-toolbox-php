<?php

namespace PageExperience\Engine\Dsl\Parser;

use PageExperience\Engine\Dsl\Expression;
use PageExperience\Engine\Dsl\Expression\SomeExpression;
use PageExperience\Engine\Dsl\Parser;

/**
 * Parser for a tool-specific DSL.
 *
 * @package ampproject/px-toolbox
 */
final class ToolDsl implements Parser
{
    /**
     * DSL to parse.
     *
     * @var array<string, mixed>
     */
    private $dsl;

    /**
     * Instantiate a ToolDsl specific parser object.
     *
     * @param array<string, mixed> $dsl DSL to parse.
     */
    public function __construct(array $dsl)
    {
        $this->dsl = $dsl;
    }

    /**
     * Parse the DSL(s) into an object hierarchy.
     *
     * @return array<Expression>
     */
    public function parse()
    {
        return [new SomeExpression()];
    }
}
