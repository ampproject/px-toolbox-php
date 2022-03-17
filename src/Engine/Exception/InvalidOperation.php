<?php

namespace PageExperience\Engine\Exception;

use InvalidArgumentException;
use PageExperience\Engine\Dsl\Operation;

/**
 * Exception thrown when an invalid operation is being requested.
 *
 * @package ampproject/px-toolbox
 */
final class InvalidOperation extends InvalidArgumentException implements PxEngineException
{
    /**
     * Instantiate an InvalidOperation exception for an operation when a RuleCollection was expected.
     *
     * @param Operation $operation Operation that was requested.
     * @return self
     */
    public static function whenExpectingRuleCollection(Operation $operation)
    {
        $operationClass = get_class($operation);
        $message        = "Expected RuleCollection object, got '{$operationClass}' instead.";

        return new self($message);
    }
}
