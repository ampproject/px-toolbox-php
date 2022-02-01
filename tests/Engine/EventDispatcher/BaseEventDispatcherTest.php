<?php

namespace PageExperience\Tests\Engine\EventDispatcher;

use PageExperience\Engine\Event;
use PageExperience\Tests\TestCase;
use PageExperience\Engine\StoppableEvent;
use PageExperience\Engine\ListenerProvider;
use PageExperience\Engine\EventDispatcher\BaseEventDispatcher;

/**
 * Test the BaseEventDispatcher class.
 *
 * @package ampproject/px-toolbox-php
 */
final class BaseEventDispatcherTest extends TestCase
{
    /**
     * Test the class instance.
     */
    public function testItCanBeInstantiated()
    {
        $listenProvider  = $this->createMock(ListenerProvider::class);
        $eventDispatcher = new BaseEventDispatcher($listenProvider);

        self::assertInstanceOf(BaseEventDispatcher::class, $eventDispatcher);
    }

    /**
     * Test dispatching a StoppableEvent which is stopped propagating.
     */
    public function testDispatchingStoppableEvent()
    {
        $event           = $this->createMock(StoppableEvent::class);
        $listenProvider  = $this->createMock(ListenerProvider::class);
        $eventDispatcher = new BaseEventDispatcher($listenProvider);

        $event->method('isPropagationStopped')->willReturn(true);

        $event = $eventDispatcher->dispatch($event);

        self::assertInstanceOf(StoppableEvent::class, $event);
    }

    /**
     * Test dispatching a StoppableEvent which is still propagating.
     */
    public function testDispatchingStoppableEventStillPropagating()
    {
        $event           = $this->createMock(StoppableEvent::class);
        $listenProvider  = $this->createMock(ListenerProvider::class);
        $eventDispatcher = new BaseEventDispatcher($listenProvider);

        $event->method('isPropagationStopped')->willReturn(false);
        $listenProvider->method('getListenersForEvent')->willReturn([function () {
        }]);

        $event = $eventDispatcher->dispatch($event);

        self::assertInstanceOf(StoppableEvent::class, $event);
    }

    /**
     * Test dispatching a regular Event.
     */
    public function testDispatchingEventToEventListener()
    {
        $event           = $this->createMock(Event::class);
        $listenProvider  = $this->createMock(ListenerProvider::class);
        $eventDispatcher = new BaseEventDispatcher($listenProvider);

        $listenProvider->method('getListenersForEvent')->willReturn([function () {
        }]);

        $event = $eventDispatcher->dispatch($event);

        self::assertInstanceOf(Event::class, $event);
    }
}
