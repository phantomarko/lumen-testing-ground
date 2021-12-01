<?php

namespace App\Infrastructure\Core\Controller\Http;

use Illuminate\Http\JsonResponse;

abstract class BaseResponse extends JsonResponse
{
    private const DATA_KEY = 'data';
    private const STATUS_KEY = 'status';
    private const MESSAGE_KEY = 'message';

    public function __construct(
        $data = null,
        $status = 200,
        $message = null,
        $headers = [],
        $options = 0
    )
    {
        $array = [
            self::DATA_KEY => $data,
            self::STATUS_KEY => $status,
            self::MESSAGE_KEY => $message
        ];

        if (is_null($array[self::DATA_KEY])) {
            unset($array[self::DATA_KEY]);
        }

        if (is_null($array[self::MESSAGE_KEY])) {
            unset($array[self::MESSAGE_KEY]);
        }

        parent::__construct(
            $array,
            $status,
            $headers,
            $options
        );
    }
}
