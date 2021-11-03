<?php

namespace PageExperience\Engine\Exception;

use InvalidArgumentException;

/**
 * Exception thrown when an invalid tool is being requested.
 *
 * @package ampproject/px-toolbox
 */
final class InvalidTool extends InvalidArgumentException implements PxEngineException
{

    /**
     * Instantiate an InvalidTool exception for a FQCN that does not implement the Tool interface.
     *
     * @param class-string $fqcn FQCN of the tool that was requested.
     * @return self
     */
    public static function forBadFqcn($fqcn)
    {
        $message = "FQCN provided does not implement the \PageExperience\Engine\Tool interface: '{$fqcn}'.";

        return new self($message);
    }

    /**
     * Instantiate an InvalidTool exception for an instantiated object that does not implement the Tool interface.
     *
     * @param mixed $badTool Bad Tool object that was instantiated.
     * @return self
     */
    public static function forBadObject($badTool)
    {
        $message = 'Instantiated tool object does not implement the \PageExperience\Engine\Tool interface: '
                   . new ValueDump($badTool);

        return new self($message);
    }
}
