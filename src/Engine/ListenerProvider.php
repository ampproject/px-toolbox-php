<?php

namespace PageExperience\Engine;

/**
 * Mapper from an event to the listeners that are applicable to that event.
 *
 * TODO: This interface is meant to extend PSR-14's ListenerProviderInterface once we bumped the PHP minimum to 7.2+.
 *
 * @package ampproject/px-toolbox
 */
interface ListenerProvider
{
    /**
     * Get listeners for a specific event.
     *
     * @param Event $event An event for which to return the relevant listeners.
     * @return iterable<callable> An iterable (array, iterator, or generator) of callables.
     */
    public function getListenersForEvent(Event $event);
}
