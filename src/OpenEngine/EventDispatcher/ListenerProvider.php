<?php declare(strict_types=1);

namespace OpenEngine\EventDispatcher;

use OpenEngine\EventDispatcher\Interfaces\ListenerProviderConfigInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Mapper from an event to the listeners that are applicable to that event.
 */
class ListenerProvider implements ListenerProviderInterface
{
    /**
     * @var ListenerProviderConfigInterface
     */
    private $config;

    /**
     * ListenerProvider constructor.
     * @param ListenerProviderConfigInterface $config
     */
    public function __construct(ListenerProviderConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable[callable]
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event): iterable
    {
        return $this->config->getListeners(\get_class($event));
    }
}
