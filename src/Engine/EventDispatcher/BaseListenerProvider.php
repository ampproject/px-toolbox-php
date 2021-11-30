<?php

namespace PageExperience\Engine\EventDispatcher;

use PageExperience\Engine\Event;
use PageExperience\Engine\ListenerProvider;

/**
 * Base implementation of the page experience engine's listener provider.
 *
 * @package ampproject/px-toolbox
 */
class BaseListenerProvider implements ListenerProvider
{
    /**
     * Associative array of listeners.
     *
     * @var array<class-string, array<callable>>
     */
    private $listeners = [];

    /**
     * Get listeners for a specific event.
     *
     * @param Event $event An event for which to return the relevant listeners.
     * @return array<callable> An iterable (array, iterator, or generator) of callables.
     */
    public function getListenersForEvent(Event $event)
    {
        $eventType = get_class($event);

        if (array_key_exists($eventType, $this->listeners)) {
            return $this->listeners[$eventType];
        }

        return [];
    }

    /**
     * Add a listener to the listener provider.
     *
     * @param class-string $eventType Type of the event to add a listener for.
     * @param callable     $callable  Listener callable to add.
     * @return $this
     */
    public function addListener($eventType, callable $callable)
    {
        if (! array_key_exists($eventType, $this->listeners)) {
            $this->listeners[$eventType] = [];
        }

        $this->listeners[$eventType][] = $callable;

        return $this;
    }

    /**
     * Clear listeners for a given event type.
     *
     * @param class-string $eventType Type of the event to clear the listeners for.
     * @return void
     */
    public function clearListeners($eventType)
    {
        if (array_key_exists($eventType, $this->listeners)) {
            unset($this->listeners[$eventType]);
        }
    }
}
