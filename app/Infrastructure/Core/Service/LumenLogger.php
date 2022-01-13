<?php

namespace App\Infrastructure\Core\Service;

use App\Domain\Core\Service\Logger;
use Illuminate\Support\Facades\Log;

class LumenLogger implements Logger
{

    public function emergency(string $message, array $contextData = [])
    {
        Log::emergency($message, $contextData);
    }

    public function alert(string $message, array $contextData = [])
    {
        Log::alert($message, $contextData);
    }

    public function critical(string $message, array $contextData = [])
    {
        Log::critical($message, $contextData);
    }

    public function error(string $message, array $contextData = [])
    {
        Log::error($message, $contextData);
    }

    public function warning(string $message, array $contextData = [])
    {
        Log::warning($message, $contextData);
    }

    public function notice(string $message, array $contextData = [])
    {
        Log::notice($message, $contextData);
    }

    public function debug(string $message, array $contextData = [])
    {
        Log::debug($message, $contextData);
    }
}
