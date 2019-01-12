<?php declare(strict_types=1);

namespace OpenEngine\EventDispatcher;

class RegisteredListener
{
    /**
     * @var string
     */
    private $eventClass;

    /**
     * @var callable
     */
    private $listener;

    /**
     * @var int
     */
    private $priority;

    /**
     * RegisteredListener constructor.
     * @param string $eventClass
     * @param callable $listener
     * @param int $priority
     */
    public function __construct(string $eventClass, callable $listener, int $priority)
    {
        $this->eventClass = $eventClass;
        $this->listener = $listener;
        $this->priority = $priority;
    }


    /**
     * @return callable
     */
    public function getListener(): callable
    {
        return $this->listener;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return string
     */
    public function getEventClass(): string
    {
        return $this->eventClass;
    }
}
