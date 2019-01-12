<?php declare(strict_types=1);

namespace OpenEngine\EventDispatcher;

use OpenEngine\EventDispatcher\Interfaces\ListenerProviderConfigInterface;

class ListenerProviderConfig implements ListenerProviderConfigInterface
{
    /**
     * @var RegisteredListener[]
     */
    private $listeners = [];

    /**
     * Add listener
     *
     * @param string $eventClass
     * @param callable $listener
     * @param int $priority Zero is highest priority
     */
    public function addListener(string $eventClass, callable $listener, int $priority = 1000): void
    {
        $this->listeners = new RegisteredListener($eventClass, $listener, $priority);
    }

    /**
     * Get sorted by priority listeners for event $eventClass
     *
     * @param string $eventClass
     * @return iterable
     */
    public function getListeners(string $eventClass): iterable
    {
        $listeners = [];

        foreach ($this->listeners as $listener) {
            if ($eventClass === $listener->getEventClass()) {
                $listeners[] = $listener;
            }
        }

        usort($listeners, function (RegisteredListener $first, RegisteredListener $second) {
            if ($first->getPriority() < $second->getPriority()) {
                return -1;
            }

            if ($first->getPriority() > $second->getPriority()) {
                return 1;
            }

            return 0;
        });

        foreach ($listeners as $key => $listener) {
            $listeners[$key] = $listener->getListener();
        }

        return $listeners;
    }
}
