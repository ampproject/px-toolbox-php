<?php

namespace PageExperience\Engine\EventDispatcher;

use PageExperience\Engine\Event;
use PageExperience\Engine\EventDispatcher;
use PageExperience\Engine\ListenerProvider;
use PageExperience\Engine\StoppableEvent;

/**
 * Base implementation of the page experience engine's event dispatcher.
 *
 * @package ampproject/px-toolbox
 */
class BaseEventDispatcher implements EventDispatcher
{
    /**
     * Listener provider instance to use.
     *
     * @var ListenerProvider
     */
    private $listenerProvider;

    /**
     * Instantiate an event provider object.
     *
     * @param ListenerProvider $listenerProvider Listener provider instance to use.
     */
    public function __construct(ListenerProvider $listenerProvider)
    {
        $this->listenerProvider = $listenerProvider;
    }

    /**
     * Dispatch an event to all listeners.
     *
     * @param Event $event Event to dispatch.
     * @return Event Event potentially modified by listeners.
     */
    public function dispatch(Event $event)
    {
        if ($event instanceof StoppableEvent && $event->isPropagationStopped()) {
            return $event;
        }

        foreach ($this->listenerProvider->getListenersForEvent($event) as $listener) {
            $listener($event);
        }

        return $event;
    }
}
