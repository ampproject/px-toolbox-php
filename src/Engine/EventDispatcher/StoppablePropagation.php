<?php

namespace PageExperience\Engine\EventDispatcher;

/**
 * Trait that implements the stoppable propagation defined by the StoppableEvent interface.
 *
 * @package ampproject/px-toolbox
 */
trait StoppablePropagation
{
    /**
     * Whether no further event listeners should be triggered.
     *
     * @var bool
     */
    private $propagationStopped = false;

    /**
     * Is propagation stopped?
     *
     * This will typically only be used by the dispatcher to determine if the previous listener halted propagation.
     *
     * @return bool True if the event is complete and no further listeners should be called, otherwise false.
     */
    public function isPropagationStopped()
    {
        return $this->propagationStopped;
    }

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no further event listener will be triggered once any
     * trigger calls stopPropagation().
     *
     * @return void
     */
    public function stopPropagation()
    {
        $this->propagationStopped = true;
    }
}
