<?php

namespace PageExperience\Tests\Engine\EventDispatcher;

use PageExperience\Engine\Event;
use PageExperience\Tests\TestCase;
use PageExperience\Engine\EventDispatcher\BaseListenerProvider;

/**
 * Test the BaseListenerProvider class.
 *
 * @package ampproject/px-toolbox-php
 */
final class BaseListenerProviderTest extends TestCase
{
    /**
     * Test the class instance.
     */
    public function testItCanBeInstantiated()
    {
        $eventListener = new BaseListenerProvider();

        self::assertInstanceOf(BaseListenerProvider::class, $eventListener);
    }

    /**
     * Test basic add, get and clear event operations.
     */
    public function testBasicOperations()
    {
        $eventListener = new BaseListenerProvider();
        $event         = $this->createMock(Event::class);
        $eventType     = get_class($event);

        $listeners = $eventListener->getListenersForEvent($event);
        self::assertEquals([], $listeners);

        $eventListener->addListener($eventType, function () {} );
        $eventListener->addListener($eventType, function () {} );

        $listeners = $eventListener->getListenersForEvent($event);
        self::assertIsArray($listeners);
        self::assertCount(2, $listeners);

        $eventListener->clearListeners($eventType);
        $listeners = $eventListener->getListenersForEvent($event);
        self::assertEquals([], $listeners);
    }
}
