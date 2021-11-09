<?php

namespace PageExperience\Engine;

/**
 * Defines a dispatcher for events.
 *
 * TODO: This interface is meant to extend PSR-14's EventDispatcherInterface once we bumped the PHP minimum to 7.2+.
 *
 * @package ampproject/px-toolbox
 */
interface EventDispatcher
{
    /**
     * Provide all relevant listeners with an event to process.
     *
     * @param Event $event The object to process.
     *
     * @return Event The event that was passed, now modified by listeners.
     */
    public function dispatch(Event $event);
}
