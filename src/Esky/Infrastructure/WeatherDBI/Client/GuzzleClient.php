<?php

declare(strict_types=1);

namespace Esky\Infrastructure\WeatherDBI\Client;

use Esky\Infrastructure\WeatherDBI\ClientInterface;
use GuzzleHttp\Psr7\Request;

class GuzzleClient implements ClientInterface
{
    private \GuzzleHttp\ClientInterface $client;

    public function __construct(\GuzzleHttp\ClientInterface $client)
    {
        $this->client = $client;
    }

    public function get(string $uri): string
    {
        $request = new Request('GET', $uri);
        $response = $this->client->send($request);

        return (string) $response->getBody();
    }
}
