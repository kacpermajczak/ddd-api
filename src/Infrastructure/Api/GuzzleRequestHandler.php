<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use GuzzleHttp\Psr7\Request;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

final class GuzzleRequestHandler
{
    public function handleRequest(string $url, string $method): string
    {
        $adapter = GuzzleAdapter::createWithConfig(
            [
                'timeout' => 10,
            ]
        );
        $response = $adapter->sendRequest(
            new Request($method, $url)
        );

        return $response->getBody()->getContents();
    }
}
