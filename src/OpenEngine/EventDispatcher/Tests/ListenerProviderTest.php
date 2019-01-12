<?php declare(strict_types=1);

namespace OpenEngine\EventDispatcher\Tests;

use OpenEngine\EventDispatcher\EventDispatcher;
use OpenEngine\EventDispatcher\ListenerProvider;
use OpenEngine\EventDispatcher\ListenerProviderConfig;
use OpenEngine\EventDispatcher\Tests\Dummy\BarEvent;
use OpenEngine\EventDispatcher\Tests\Dummy\FooEvent;
use PHPUnit\Framework\TestCase;

class ListenerProviderTest extends TestCase
{
    public function testCountOfListeners(): void
    {
        $fooEvent = new FooEvent();
        $listenerProvider = new ListenerProvider($this->getConfig());
        $listeners = $listenerProvider->getListenersForEvent($fooEvent);
        self::assertCount(2, $listeners);
    }

    public function testPriority(): void
    {
        $fooEvent = new FooEvent();
        $listenerProvider = new ListenerProvider($this->getConfig());
        $dispatcher = new EventDispatcher($listenerProvider);
        $dispatcher->dispatch($fooEvent);
        $this->expectOutputString('high-priority; low-priority');
    }

    private function getConfig(): ListenerProviderConfig
    {
        $config = new ListenerProviderConfig();

        $config->addListener(FooEvent::class, function (FooEvent $event) {
            print '; low-priority';
            return $event;
        }, 20);

        $config->addListener(BarEvent::class, function (BarEvent $event) {
            print 'b';
            return $event;
        }, 40);

        $config->addListener(FooEvent::class, function (FooEvent $event) {
            print 'high-priority';
            return $event;
        }, 0);

        return $config;
    }
}
