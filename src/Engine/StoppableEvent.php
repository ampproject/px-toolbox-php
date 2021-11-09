<?php

namespace PageExperience\Engine;

/**
 * An event whose processing may be interrupted when the event has been handled.
 *
 * A dispatcher implementation must check to determine if an event is marked as stopped after each listener is called.
 * If it is then the dispatcher should return immediately without calling any further listeners.
 *
 * TODO: This interface is meant to extend PSR-14's StoppableEventInterface once we bumped the PHP minimum to 7.2+.
 *
 * @package ampproject/px-toolbox
 */
interface StoppableEvent extends Event
{
    /**
     * Is propagation stopped?
     *
     * This will typically only be used by the dispatcher to determine if the previous listener halted propagation.
     *
     * @return bool True if the event is complete and no further listeners should be called, otherwise false.
     */
    public function isPropagationStopped();
}
