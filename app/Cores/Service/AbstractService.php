<?php

namespace App\Cores\Service;

use Symfony\Component\HttpFoundation\Response;

abstract class AbstractService
{
    protected function responseData(array $payload, int $code = Response::HTTP_BAD_REQUEST)
    {
        if (isset($payload['error']) && $payload['error'] === true) {
            return [
                'error' => true,
                'code' => $code,
                'message' => $payload['message'] ?? null,
            ];
        }
        return [
            'error' => false,
            'data' => $payload['data'] ?? null,
            'message' => $payload['message'] ?? null,
        ];
    }
}