<?php declare(strict_types=1);

namespace OpenEngine\EventDispatcher\Tests;

use OpenEngine\EventDispatcher\EventDispatcher;
use OpenEngine\EventDispatcher\ListenerProvider;
use OpenEngine\EventDispatcher\ListenerProviderConfig;
use OpenEngine\EventDispatcher\Tests\Dummy\FooEvent;
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{
    private function getListenerProvider(): ListenerProvider
    {
        $listenerProviderConfig = new ListenerProviderConfig();
        return new ListenerProvider($listenerProviderConfig);
    }

    public function testReturnSameEvent(): void
    {
        $dispatcher = new EventDispatcher($this->getListenerProvider());
        $event = $dispatcher->dispatch(new FooEvent());

        self::assertInstanceOf(FooEvent::class, $event);
    }
}
