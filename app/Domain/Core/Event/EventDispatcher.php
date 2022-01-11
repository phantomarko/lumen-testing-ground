<?php

namespace App\Domain\Core\Event;

interface EventDispatcher
{
    public function dispatch(Event $event): void;
}
