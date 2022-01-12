<?php

namespace App\Infrastructure\Core\Event;

use App\Domain\Core\Event\Event;
use App\Domain\Core\Event\EventDispatcher;

class LumenEventDispatcher implements EventDispatcher
{
    public function dispatch(Event $event): void
    {
        event($event);
    }
}
