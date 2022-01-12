<?php

namespace unit\Domain\Core\Event;

use App\Domain\Core\Event\Event;
use App\Domain\Core\Event\EventDispatcher;

class DummyEventDispatcher implements EventDispatcher
{
    private int $numberOfDispatchedEvents = 0;

    public function dispatch(Event $event): void
    {
        $this->numberOfDispatchedEvents++;
    }

    public function getNumberOfDispatchedEvents(): int
    {
        return $this->numberOfDispatchedEvents;
    }
}
