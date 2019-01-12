<?php declare(strict_types=1);

namespace OpenEngine\EventDispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Defines a dispatcher for events.
 */
class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var ListenerProviderInterface
     */
    private $provider;

    /**
     * EventDispatcher constructor.
     * @param ListenerProviderInterface $provider
     */
    public function __construct(ListenerProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Provide all listeners with an event to process.
     *
     * @param object $event
     *  The object to process.
     *
     * @return object
     *  The Event that was passed, now modified by listeners.
     */
    public function dispatch(object $event)
    {
        $returnedEvent = $event;

        foreach ($this->provider->getListenersForEvent($event) as $listener) {
            $returnedEvent = $listener($event);

            if (!$returnedEvent instanceof $event) {
                throw new \LogicException('Listener must return same event');
            }

            if ($returnedEvent instanceof StoppableEventInterface && $returnedEvent->isPropagationStopped()) {
                break;
            }
        }

        return $returnedEvent;
    }
}
