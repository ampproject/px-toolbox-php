<?php

namespace PageExperience\Engine\Exception;

use LogicException;
use PageExperience\Engine\Dsl\Parser;

/**
 * Exception thrown when a code path is being triggered that has not yet been implemented.
 *
 * @package ampproject/px-toolbox
 */
final class NotImplemented extends LogicException implements PxEngineException
{
    /**
     * Instantiate a NotImplemented exception for using a parallel optimization tool stack.
     *
     * @return self
     */
    public static function forParallelOptimization()
    {
        $message = 'Optimization requests on a parallel tool stack have not been implemented (yet).';

        return new self($message);
    }

    /**
     * Instantiate a NotImplemented exception for using a DSL operation that was is unknown.
     *
     * @param string $operation Operation that is not yet implemented.
     * @return self
     */
    public static function forDslOperation($operation)
    {
        $message = "The DSL operation '{$operation}' has not been implemented (yet).";

        return new self($message);
    }

    /**
     * Instantiate a NotImplemented exception for using a parser type that is not known.
     *
     * @param Parser $parser Parser that is not yet implemented.
     * @return self
     */
    public static function forParserType($parser)
    {
        $parserClass = get_class($parser);

        $message = "Support for the parser of type '{$parserClass}' has not been implemented (yet).";

        return new self($message);
    }
}
