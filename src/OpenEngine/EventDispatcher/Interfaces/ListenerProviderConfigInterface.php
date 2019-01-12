<?php declare(strict_types=1);

namespace OpenEngine\EventDispatcher\Interfaces;

interface ListenerProviderConfigInterface
{
    /**
     * Add listener
     *
     * @param string $eventClass
     * @param callable $listener
     * @param int $priority Zero is highest priority
     */
    public function addListener(string $eventClass, callable $listener, int $priority = 1000): void;

    /**
     * Get sorted by priority listeners for event $eventClass
     *
     * @param string $eventClass
     * @return iterable
     */
    public function getListeners(string $eventClass): iterable;
}
