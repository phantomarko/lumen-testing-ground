<?php

namespace App\Infrastructure\Core\Controller\Http;

use Illuminate\Http\JsonResponse;

class BaseResponse extends JsonResponse
{
    /**
     * @inheritDoc
     */
    public function __construct($data = null, $status = 200, $message = null, $headers = [], $options = 0, $json = false)
    {
        $array = [
            'data' => $data,
            'status' => $status,
            'message' => $message
        ];

        if (is_null($array['data'])) {
            unset($array['data']);
        }

        if (is_null($array['message'])) {
            unset($array['message']);
        }

        parent::__construct(
            $array,
            $status,
            $headers,
            $options,
            $json
        );
    }
}
