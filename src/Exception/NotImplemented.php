<?php

namespace AmpProject\Exception;

use LogicException;
use PageExperience\Exception\PxEngineException;

/**
 * Exception thrown when a codepath is being triggered that has not yet been implemented.
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
}
