<?php

namespace App\Domain\Core\Service;

interface Logger
{
    public function emergency(string $message, array $contextData = []);

    public function alert(string $message, array $contextData = []);

    public function critical(string $message, array $contextData = []);

    public function error(string $message, array $contextData = []);

    public function warning(string $message, array $contextData = []);

    public function notice(string $message, array $contextData = []);

    public function debug(string $message, array $contextData = []);
}
